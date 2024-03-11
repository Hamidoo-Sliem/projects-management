@extends('layouts.app')

@section('style')
<style type="text/css">
    *,
*:before,
*:after {
  box-sizing: border-box;
}
.wrapper {
  /*min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;*/
}

.steps {
  max-width: 450px;
  /*margin: 0 auto;*/
}

.step {
  display: flex;
  position: relative;
}
.step::after {
  content: "";
  position: absolute;
  right: 15px;
  top: 30px;
  height: 0;
  width: 2px;
  background-color: #007ea7;
}
.step:not(:last-child)::before {
  content: ">";
  position: absolute;
  right:-6px;
  bottom: -12px;
  z-index:100;
  font-size:26px;
  font-weight:bolder;
  text-align:center;
  width:50px;
  transform:rotate(270deg);
  color: #007ea7;
}
.step .info {
  margin: 8px 0 20px;
}
.step .title {
  font-size: 16px;
  font-weight: 600;
  margin: 0 0 8px;
  color: white;
}
[data-theme='light'] .step .title {
  color: #000;
}
.step .text {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.7);
  padding-bottom: 0;
  margin: 0;
}
[data-theme='light'] .step .text {
  color: grey;
}
.step:not(:last-child):after {
  height: 75%;
}

.number {
  width: 32px;
  height: 32px;
  background-color: #000;
  border-radius: 50%;
  border: 2px solid #007ea7;
  flex-shrink: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 15px;
  font-weight: 600;
  margin-left: 14px;
}
.number.completed {
  background-color: #007ea7;
}
.number svg {
  width: 16px;
  height: 16px;
  object-fit: contain;
}
.number svg path {
  fill: white;
}
div.card-toolbar2 {
  color:#aaa;
  font-size:0.85em;
}
[data-theme='light'] a.titlex {
  color: #000;
}
[data-theme='dark'] a.titlex {
  color: #fff;
}
div#statusx {
  display:flex;
  flex-wrap:nowrap;
}
div#statusx div {
 margin-left:10px;
 padding-inline:2px;
 text-align:center;
}
div#statusx div span {
 display:block;
 margin-bottom:8px;
}
</style>
@append 

@section('breadcrumbs')
<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
   <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">تفاصيل المشاريع
      <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
      <small class="text-muted fs-7 fw-semibold my-1 ms-1">التايم لاين</small>
   </h1>
</div>
@stop

@section('content')
<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
<div class="row g-6 g-xl-9" id="projectList">
@forelse($rows as $row)
                <!--begin::Col-->
                <div class="card col-md-6 col-xl-4 projectData" data-name="{{ $row->title }}" style="margin-left:10px;width:32%;">
                    <!--begin:: Card header-->
                   
                        <div class="card-header border-0 pt-9">
                            <div class="card-title m-0" style="float:right;margin-bottom:20px;">
                                <div class="symbol symbol-50px w-50px bg-light"> <img src="{{ asset('storage/' . $row->logo) }}" alt="{{ $row->title }}" class="p-3" /> </div>
                            </div>
                            <div class="card-toolbar" style="float:left;margin-bottom:20px;"> <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $row->status->trans }}</span></div>
                        </div>
                        <!--end:: Card header-->
                        <!--begin:: Card body-->
                        <div class="card-body p-9" style="clear:both;">
                            <!--begin::Name-->
                            <div class="fs-3 fw-bold text-dark" style="clear:both;"> 
                            <a href="#" title="اضغط لمشاهدة الخط الزمنى للمشروع" data-bs-toggle="modal" data-bs-target="#modalTime-{{$row->id}}" class="cardx border-hover-primary titlex">{{ $row->title }}</a>
                            <span title="البلاغات" data-bs-toggle="modal" data-bs-target="#modalRflags-{{$row->id}}" style="float:left;margin-right:10px;cursor:pointer;"><i class="bi bi-flag-fill" style="color:#f1416c;font-size:18px;"></i></span>
                           
                            <!--modal-->
                              <div class="modal fade" id="modalRflags-{{$row->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered mw-1000px">
                                      <div class="modal-content">
                                      <div class="modal-header">
                                          <h3><i class="bi bi-flag-fill" style="color:#fff;font-size:1.3rem;"></i> البلاغات لمشروع {{$row->title}}</h3>
                                          <br>
                                      </div>
                                      <div class="modal-body scroll-y mx-xl-18 pb-15 mx-5">
                                            <!--ur content-->
                                    <table id="kt_datatable_both_scrolls" class="table table-striped table-row-bordered gy-5 gs-7">
                                      <thead>
                                          <tr class="fw-bold fs-7 text-white border-bottom border-gray-200 py-4 bg-danger">
                                              <th>البلاغ</th> 
                                              <th>حالة البلاغ</th>
                                              <th>نوع البلاغ</th>
                                              <th>صاحب البلاغ</th>
                                              <th>تاريخ البلاغ</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @php \App\Http\Controllers\Backoffice\AdminController::_getRFlags($row->id); @endphp
                                      </tbody>
                                    </table>
                                          <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="إلغاء">
                                      </div>
                                      </div>
                                  </div>
                                  </div>
                            <!--end-modal-->
                           
                            <span title="العرقلات" data-bs-toggle="modal" data-bs-target="#modalObstacle-{{$row->id}}" style="float:left;cursor:pointer;"><i class="bi bi-cone" style="color:#f1416c;font-size:18px;"></i></span>
                           
                          <!--modal-->
                          <div class="modal fade" id="modalObstacle-{{$row->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered mw-1000px">
                                      <div class="modal-content">
                                      <div class="modal-header">
                                          <h3><i class="bi bi-cone" style="color:#fff;font-size:1.3rem;"></i> العرقلات لمشروع {{$row->title}}</h3>
                                          <br>
                                      </div>
                                      <div class="modal-body scroll-y mx-xl-18 pb-15 mx-5">
                                            <!--ur content-->
                                    <table id="kt_datatable_both_scrolls" class="table table-striped table-row-bordered gy-5 gs-7">
                                      <thead>
                                          <tr class="fw-bold fs-7 text-white border-bottom border-gray-200 py-4 bg-danger">
                                              <th>عنوان العرقلة</th> 
                                              <th>وصف العرقلة</th>
                                              <th>نوع العرقلة</th>
                                              <th>الى من</th>
                                              <th>تم الاغلاق ؟</th>
                                              <th>تاريخ العرقلة</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @php \App\Http\Controllers\Backoffice\AdminController::_getObstacles($row->id) @endphp
                                      </tbody>
                                    </table>
                                          <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="إلغاء">
                                      </div>
                                      </div>
                                  </div>
                                  </div>
                            <!--end-modal-->
                          
                          </div>
                            <!--end::Name-->
                            <div id="statusx">
                            <div class="card-toolbar2"> 
                              <span class="badge badge-light-warning fw-bold me-auto px-4 py-3">
                                الحالة السابقة 
                              </span>
                              {{ @\App\Http\Controllers\Backoffice\AdminController::_getPrevStatus($row->id) }}
                             </div>

                            <div class="card-toolbar2"> 
                              <span class="badge badge-light-success fw-bold me-auto px-4 py-3">
                              الحالة الجاريه
                              </span>
                              {{ @\App\Http\Controllers\Backoffice\AdminController::_getCurStatus($row->id) }}
                             </div>

                             <div class="card-toolbar2"> 
                              <span class="badge badge-light-info fw-bold me-auto px-4 py-3">
                              الحالة القادمة
                              </span>
                              {{ @\App\Http\Controllers\Backoffice\AdminController::_getNexStatus($row->id) }}
                             </div>
                             </div>
                             <br>
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
                    
                    <!--end::Card-->
                    <!--modal-->
                    <div class="modal fade" id="modalTime-{{$row->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered mw-1000px">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h3><i class="bi bi-calendar-week" style="color:#fff;font-size:1.3rem;"></i> الخط الزمنى لمشروع {{$row->title}}</h3>
                                                <br>
                                            </div>
                                            <div class="modal-body scroll-y mx-xl-18 pb-15 mx-5">
                                                <!--ur content-->
                                                <div class='wrapper_all'>
                                                    <div class='steps' id='steps'>
                                                        @php 
                                                          $ii = 1;
                                                          $qy = \DB::table('project_transaction_history')
                                                            ->select('user_id','status_id','is_done',\DB::raw('Date(created_at) AS date,HOUR(created_at) AS H,MINUTE(created_at) AS M'))
                                                            ->where('project_id',$row->id)->get();
                                                        @endphp
                                                      @foreach($qy as $vv)
                                                        <div class='step'>
                                                            @if($vv->is_done == 1)
                                                            <div class='number completed'>
                                                            <svg viewBox="0 0 512 512" width="100" title="check">
                                                                <path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" />
                                                            </svg>
                                                            </div>
                                                            @else
                                                            <div class='number'>{!!$ii!!}</div>
                                                            @endif
                                                            <div class='info'>
                                                            <p class='title'>
                                                                {{\App\Models\TransactionHistory::find($vv->status_id)->title}}
                                                            </p>
                                                            <p class='text'>
                                                              <span>{{$vv->date}}  فى الساعة {{$vv->H}}:{{$vv->M}} {{($vv->H <= 12) ? 'ص' : 'م'}}</span>
                                                              <br>
                                                              <span>بواسطة {{\App\Models\User::find($vv->user_id)->name}} </span>
                                                            </p>
                                                            </div>
                                                        </div>
                                                        @php $ii++; @endphp 
                                                      @endforeach
                                                    </div>
                                                </div>
                                                <!--end -->
                                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="إلغاء">
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    <!--end-modal-->
                </div>
                <!--end::Col-->
            @empty @include('partials.alerts.empty', ['msg' => $title])
            @endforelse    
</div>
    
</div>
<!--end::Container-->
@stop
