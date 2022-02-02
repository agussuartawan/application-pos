<div class="modal fade" id="modal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg mt-0 mb-0" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Modal title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="load-here"></div>
                @include('include.loader')
            </div>
            <div class="modal-footer justify-content-between">
                <div class="mr-auto">
                    <button type="button" class="btn btn-danger modal-delete">{{ __('Hapus')}}</button>
                    <button type="button" class="btn btn-warning modal-edit">{{ __('Edit')}}</button>
                    <button type="button" class="btn btn-info modal-print">{{ __('Cetak')}}</button>
                    <button type="button" class="btn btn-info modal-pdf">{{ __('Simpan Pdf')}}</button>
                </div>
                <button type="button" class="btn btn-primary modal-save">{{ __('Simpan')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup')}}</button>
            </div>
        </div>
    </div>
</div>