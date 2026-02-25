@foreach( getHomeGlobalModals() as $modal )
    <button id="{{ $modal['modal_id'] }}_button" open-modal="{{ $modal['details']['modal_name'] }}" style="display: none;"></button>
    <!-- #basket modal -->
    <aside class="{{ $modal['details']['modal_dialog_class'] ?? '' }} " id="{{ $modal['modal_id'] }}" modal-name="{{ $modal['details']['modal_name'] }}">
        <span class="modal-overlay" close-modal="{{ $modal['details']['modal_name'] }}"></span>
        @livewire($modal['livewire_component'])
    </aside>
    <!--end::Modal - Create Property-->
@endforeach


@foreach( getHomeGlobalModals() as $modal )
    @php
        echo '
        <script>
            Livewire.on("'. $modal['emit_show'] .'", () => {
                $("[open-modal= '.$modal['details']['modal_name'].']").click()
               });

            Livewire.on("'. $modal['emit_hide'] .'", () => {
                 $("[close-modal= '.$modal['details']['modal_name'].']").click()
               });
        </script>
        ';
    @endphp
@endforeach



