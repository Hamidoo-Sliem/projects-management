@extends('layouts.app')

@section('breadcrumbs')
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center me-3 mb-lg-0 mb-5 flex-wrap">
        <h1 class="d-flex align-items-center text-dark fw-bold fs-3 my-1">{{ $list }}
            <span class="h-20px border-start ms-3 mx-2 border-gray-200"></span>
            <small class="text-muted fs-7 fw-semibold ms-1 my-1">{{ __('title_nav.dashboard') }}</small>
        </h1>
    </div>
@stop

@section('content')
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Toolbar-->
        <div class="d-flex flex-stack mb-6 flex-wrap">
            <!--begin::Heading-->
            <h3 class="fw-bold my-2">{{ $list }}</h3>
            <!--end::Heading-->
            <!--begin::Actions-->
            <div class="d-flex my-2 flex-wrap">
                @include('partials.backoffice.filter', ['placeholder' => $placeholder])
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Row-->
        <div class="row g-6 g-xl-9" id="projectList">
            <!--begin::Col-->
            @forelse($rows as $row)
                <!--begin::Col-->
                <div class="col-md-6 col-xl-4 projectData" data-name="{{ $row->title }}">
                    <!--begin:: Card header-->
                    <a href="{{ $row->status_id == 2 || $row->status_id == 5 || $row->status_id == 16 || $row->status_id == 17 ? route($resource . '.edit', $row->id) : url('project/followup/' . $row->id) }}" class="card border-hover-primary">
                        <div class="card-header border-0 pt-9">
                            <div class="card-title m-0">
                                <div class="symbol symbol-50px w-50px bg-light"> <img src="{{ asset('storage/' . $row->logo) }}" alt="{{ $row->title }}" class="p-3" /> </div>
                            </div>
                            <div class="card-toolbar"> <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $status[$row->status_id - 1]->trans }}</span></div>
                        </div>
                        <!--end:: Card header-->
                        <!--begin:: Card body-->
                        <div class="card-body p-9">
                            <!--begin::Name-->
                            <div class="fs-3 fw-bold text-dark">{{ $row->title }}</div>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <p class="fw-semibold fs-5 mt-1 mb-7 text-gray-400">إجمالي العدد: {{ $row->cases_count ?? ($row->EmpowerCharity->charity_count ?? ($row->building_count ?? '-')) }}</p>
                            <!--end::Description-->
                            <!--begin::Info-->
                            <div class="d-flex mb-5 flex-wrap">
                                <!--begin::Due-->
                                <div class="min-w-125px me-7 mb-3 rounded border border-dashed border-gray-300 py-3 px-4">
                                    <div class="fs-6 fw-bold text-gray-800">{{ $row->start_date ?? '-' }}</div>
                                    <div class="fw-semibold text-gray-400">{{ __('project.start_date') }}</div>
                                </div>
                                <!--end::Due-->
                                <!--begin::Budget-->
                                <div class="min-w-125px mb-3 rounded border border-dashed border-gray-300 py-3 px-4">
                                    <div class="fs-6 fw-bold text-gray-800">{{ $row->end_date ?? '-' }}</div>
                                    <div class="fw-semibold text-gray-400">{{ __('project.end_date') }}</div>
                                </div>
                                <!--end::Budget-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Progress-->
                            <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="تم إنجاز ما يقارب {{ $row->progress_bar }}% من المشروع">
                                <div class="bg-primary h-4px rounded" role="progressbar" style="width:{{ $row->progress_bar }}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                {{ $row->progress_bar }}%
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end:: Card body-->
                    </a>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            @empty @include('partials.alerts.empty', ['msg' => $title])
            @endforelse
            <div class="d-flex flex-stack flex-wrap pt-10">
                {!! $rows->links() !!}
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
@stop
