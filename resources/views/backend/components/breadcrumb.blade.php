<!-- start page title -->
<div class="row">
    <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                {{ !empty($breadcrumb) && array_key_exists('title', $breadcrumb) ? $breadcrumb['title'] : '' }}
            </h4>
            @if(!empty($breadcrumb) && array_key_exists('add_new_route', $breadcrumb))
           <div class="page-title-right">
            <span>
                <a class="btn btn-success waves-effect waves-light"
                href="{{ !empty($breadcrumb) && array_key_exists('add_new_route', $breadcrumb) ? route($breadcrumb['add_new_route']) : 'javascript:void(0)' }}">{{ !empty($breadcrumb) && array_key_exists('add_new_route_title', $breadcrumb) ? $breadcrumb['add_new_route_title'] : '' }}
            </a>
            </span>
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- end page title -->
