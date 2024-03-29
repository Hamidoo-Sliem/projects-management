<div class="w-100">
    <div class="fv-row mb-15" data-kt-buttons="true">
        @csrf
        <input type="hidden" id="projects_listing_route" value="{{ url('/' . Auth::user()->roles[0]->name . '/projects') }}">
        @foreach ($types as $value)
            <label
                class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 mb-6 {{ $value->id == 1 ? 'mb-6 active' : '' }}">
                <input class="btn-check projectType" type="radio" name="type_id" value="{{ $value->id }}"
                    {{ $value->id == 1 ? 'checked' : '' }} />
                <span class="d-flex">
                    <div class="symbol symbol-50px me-3">
                        <div class="symbol-label bg-light">
                            <img src="{{ asset('assets/media/svg/project-types/' . $value->icon . '.svg') }}"
                                class="h-60" alt="" />
                        </div>
                    </div>
                    <span class="ms-4">
                        <span class="fs-3 fw-bold text-gray-900 mb-2 d-block">{{ $value->title }}</span>
                    </span>
                </span>
            </label>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-lg btn-primary" id="next-step" data-kt-element="type-next">
            <span class="indicator-label">
                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5"
                            d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                            fill="currentColor" />
                        <path
                            d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                            fill="currentColor" />
                    </svg>
                </span>
                {{ __('project.inital-info') }}</span>
            <span class="indicator-progress">{{ __('site.please_wait') }}...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </div>
</div>
