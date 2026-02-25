<?php

namespace App\Services;

use App\Enums\CartStatus;
use App\Models\Cart;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected ?Cart $cart = null;

    /**
     * Get or create cart instance
     */
    public function getCart(): Cart
    {
        // Cache the cart instance
        if ($this->cart !== null) {
            return $this->cart;
        }

        if (Auth::guard('app')->check()) {
            $this->cart = Cart::firstOrCreate([
                'user_id' => Auth::guard('app')->id(),
                'status' => CartStatus::OPEN
            ]);
        } else {
            $sessionId = Session::getId();
            $this->cart = Cart::firstOrCreate([
                'session_id' => $sessionId,
                'status' => CartStatus::OPEN
            ]);
        }

        return $this->cart;
    }

    /**
     * Add project to cart
     */
    public function add(int $projectId, ?float $amount = null): bool
    {
        $project = Project::Published()->findOrFail($projectId);
        $cart = $this->getCart();

        $cart->items()->updateOrCreate(
            ['project_id' => $project->id],
            ['amount' => $amount ?? $project->target_amount]
        );

        return true;
    }

    /**
     * Get all cart items with total
     */
    public function all(): array
    {
        $cart = $this->getCart();

        $items = $cart->items()
            ->with('project:id,name,image_path')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->project->id,
                    'name' => $item->project->name,
                    'amount' => $item->amount,
                    'image' => $item->project->image_full_path,
                ];
            });

        $total = $items->sum('amount');

        return [
            'items' => $items,
            'total' => $total,
        ];
    }

    /**
     * Update item amount
     */
    public function updateAmount(int $projectId, float $amount): void
    {
        $this->getCart()
            ->items()
            ->where('project_id', $projectId)
            ->update(['amount' => $amount]);
    }

    /**
     * Increment item amount
     */
    public function incrementAmount(int $projectId, float $step = 5): void
    {
        $item = $this->getCart()
            ->items()
            ->where('project_id', $projectId)
            ->first();

        if ($item) {
            $item->increment('amount', $step);
        }
    }

    /**
     * Decrement item amount
     */
    public function decrementAmount(int $projectId, float $step = 5): void
    {
        $item = $this->getCart()
            ->items()
            ->where('project_id', $projectId)
            ->first();

        if ($item) {
            $newAmount = max(1, $item->amount - $step);
            $item->update(['amount' => $newAmount]);
        }
    }

    /**
     * Remove item from cart
     */
    public function remove(int $projectId): void
    {
        $this->getCart()
            ->items()
            ->where('project_id', $projectId)
            ->delete();
    }

    /**
     * Clear all cart items
     */
    public function clear(): void
    {
        $this->getCart()->items()->delete();
    }

    /**
     * Merge session cart to user cart after login
     */
    public function mergeSessionCartToUser(int $userId, ?string $oldSessionId = null): void
    {
        $sessionId = $oldSessionId ?? Session::getId();

        $sessionCart = Cart::where('session_id', $sessionId)
            ->where('status', CartStatus::OPEN)
            ->first();

        if (!$sessionCart) {
            return;
        }

        $userCart = Cart::firstOrCreate([
            'user_id' => $userId,
            'status' => CartStatus::OPEN
        ]);

        foreach ($sessionCart->items as $item) {
            $userCart->items()->updateOrCreate(
                ['project_id' => $item->project_id],
                ['amount' => $item->amount]
            );
        }

        $sessionCart->delete();
    }

    /**
     * Get cart items count
     */
    public function getCount(): int
    {
        return $this->getCart()->items()->count();
    }

    /**
     * Get cart total amount
     */
    public function getTotal(): float
    {
        return $this->getCart()->items()->sum('amount');
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty(): bool
    {
        return $this->getCount() === 0;
    }

    /**
     * Check if project exists in cart
     */
    public function has(int $projectId): bool
    {
        return $this->getCart()
            ->items()
            ->where('project_id', $projectId)
            ->exists();
    }
}
