<?php

namespace App\Filament\Clusters\Project;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class ProjectCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;
    protected static ?string $navigationLabel = 'المشاريع';
    protected static ?string $clusterBreadcrumb = 'المشاريع';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = true;
}
