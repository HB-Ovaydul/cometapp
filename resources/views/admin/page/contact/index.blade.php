@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Counter</h4>
                <a class="float-right text-danger" href="{{ route('con.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>CountNumber</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($all_contact as $contact)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $contact -> title }}</td>
                                    <td><i class="{{ $contact -> icon }}"></i></td>
                                    <td>{{ $contact -> count }}</td>
                                    <td>{{ $contact -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($contact -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('con.status.update',$contact -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('con.status.update',$contact -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('contact-admin.edit',$contact -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('con.trash.update', $contact -> id ) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                             </tr>
                           @empty
                               <tr>
                                <td colspan="7" class="text-light bg-dark text-center">Record No Found!</td>
                               </tr>
                           @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($form_type == 'create')
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add Expertise</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('contact-admin.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>CountNumber</label>
                        <input name="count" type="text" class="form-control">
                    </div>

                        <div class="form-group">
                            <label><button class="btn btn-sm btn-primary btn-select-modal">Select Icon</button></label>
                            <input name="icon" type="text" class="form-control ov-icon-select">
                        </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
    
   
    @if ($form_type == 'edit')
    <div class="col-xl-3 d-flex">
      <div class="card flex-fill">
          <div class="card-header">
              <h4 class="card-title">Edit Counter</h4>
          </div>

          @include('validate')
          <div class="card-body">
            <form action="{{ route('contact-admin.update', $edit -> id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>CountNumber</label>
                    <input name="count" type="text" value="{{ $edit -> count }}" class="form-control">
                </div>

                    <div class="form-group">
                        <label><button class="btn btn-sm btn-primary btn-select-modal">Select Icon</button></label>
                        <input name="icon" type="text" value="{{ $edit -> icon }}" class="form-control ov-icon-select">
                    </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>  
      </div>
  </div>
    @endif
  
</div>

{{-- Modal --}}

<div id="select-icon" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="title text-center center mb-50">
                    <h3 class="fw-400">Et-Line Icons</h3>
                    <hr>
                  </div>

                  <div class="row mod-font-select-icon">
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-mobile"></i><code>icon-mobile</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-laptop"></i><code>icon-laptop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-desktop"></i><code>icon-desktop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-tablet"></i><code>icon-tablet</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-phone"></i><code>icon-phone</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-document"></i><code>icon-document</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-documents"></i><code>icon-documents</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-search"></i><code>icon-search</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-clipboard"></i><code>icon-clipboard</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-newspaper"></i><code>icon-newspaper</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-notebook"></i><code>icon-notebook</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-book-open"></i><code>icon-book-open</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-browser"></i><code>icon-browser</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-calendar"></i><code>icon-calendar</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-presentation"></i><code>icon-presentation</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-picture"></i><code>icon-picture</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-pictures"></i><code>icon-pictures</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-video"></i><code>icon-video</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-camera"></i><code>icon-camera</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-printer"></i><code>icon-printer</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-toolbox"></i><code>icon-toolbox</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-briefcase"></i><code>icon-briefcase</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-wallet"></i><code>icon-wallet</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-gift"></i><code>icon-gift</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-bargraph"></i><code>icon-bargraph</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-grid"></i><code>icon-grid</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-expand"></i><code>icon-expand</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-focus"></i><code>icon-focus</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-edit"></i><code>icon-edit</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-adjustments"></i><code>icon-adjustments</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-ribbon"></i><code>icon-ribbon</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-hourglass"></i><code>icon-hourglass</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-lock"></i><code>icon-lock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-megaphone"></i><code>icon-megaphone</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-shield"></i><code>icon-shield</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-trophy"></i><code>icon-trophy</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-flag"></i><code>icon-flag</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-map"></i><code>icon-map</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-puzzle"></i><code>icon-puzzle</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-basket"></i><code>icon-basket</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-envelope"></i><code>icon-envelope</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-streetsign"></i><code>icon-streetsign</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-telescope"></i><code>icon-telescope</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-gears"></i><code>icon-gears</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-key"></i><code>icon-key</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-paperclip"></i><code>icon-paperclip</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-attachment"></i><code>icon-attachment</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-pricetags"></i><code>icon-pricetags</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-lightbulb"></i><code>icon-lightbulb</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-layers"></i><code>icon-layers</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-pencil"></i><code>icon-pencil</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-tools"></i><code>icon-tools</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-tools-2"></i><code>icon-tools-2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-scissors"></i><code>icon-scissors</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-paintbrush"></i><code>icon-paintbrush</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-magnifying-glass"></i><code>icon-magnifying-glass</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-circle-compass"></i><code>icon-circle-compass</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-linegraph"></i><code>icon-linegraph</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-mic"></i><code>icon-mic</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-strategy"></i><code>icon-strategy</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-beaker"></i><code>icon-beaker</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-caution"></i><code>icon-caution</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-recycle"></i><code>icon-recycle</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-anchor"></i><code>icon-anchor</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-profile-male"></i><code>icon-profile-male</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-profile-female"></i><code>icon-profile-female</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-bike"></i><code>icon-bike</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-wine"></i><code>icon-wine</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-hotairballoon"></i><code>icon-hotairballoon</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-globe"></i><code>icon-globe</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-genius"></i><code>icon-genius</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-map-pin"></i><code>icon-map-pin</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-dial"></i><code>icon-dial</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-chat"></i><code>icon-chat</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-heart"></i><code>icon-heart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-cloud"></i><code>icon-cloud</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-upload"></i><code>icon-upload</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-download"></i><code>icon-download</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-target"></i><code>icon-target</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-hazardous"></i><code>icon-hazardous</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-piechart"></i><code>icon-piechart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-speedometer"></i><code>icon-speedometer</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-global"></i><code>icon-global</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-compass"></i><code>icon-compass</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-lifesaver"></i><code>icon-lifesaver</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-clock"></i><code>icon-clock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-aperture"></i><code>icon-aperture</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-quote"></i><code>icon-quote</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-scope"></i><code>icon-scope</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-alarmclock"></i><code>icon-alarmclock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-refresh"></i><code>icon-refresh</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-happy"></i><code>icon-happy</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-sad"></i><code>icon-sad</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-facebook"></i><code>icon-facebook</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-twitter"></i><code>icon-twitter</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-googleplus"></i><code>icon-googleplus</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-rss"></i><code>icon-rss</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-tumblr"></i><code>icon-tumblr</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-linkedin"></i><code>icon-linkedin</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="icon-dribbble"></i><code>icon-dribbble</code>
                      </div>
                    </div>
                  </div>
                <!-- Et-line-icon -->
        
                <div class="title text-center center mb-50">
                    <h3 class="fw-400">Themify Icons</h3>
                 <hr>
                </div>
                <div class="row mod-font-select-icon">
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-wand"></i><code>ti-wand</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-volume"></i><code>ti-volume</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-user"></i><code>ti-user</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-unlock"></i><code>ti-unlock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-unlink"></i><code>ti-unlink</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-trash"></i><code>ti-trash</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-thought"></i><code>ti-thought</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-target"></i><code>ti-target</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-tag"></i><code>ti-tag</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-tablet"></i><code>ti-tablet</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-star"></i><code>ti-star</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-spray"></i><code>ti-spray</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-signal"></i><code>ti-signal</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shopping-cart"></i><code>ti-shopping-cart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shopping-cart-full"></i><code>ti-shopping-cart-full</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-settings"></i><code>ti-settings</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-search"></i><code>ti-search</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-zoom-in"></i><code>ti-zoom-in</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-zoom-out"></i><code>ti-zoom-out</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-cut"></i><code>ti-cut</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ruler"></i><code>ti-ruler</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ruler-pencil"></i><code>ti-ruler-pencil</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ruler-alt"></i><code>ti-ruler-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bookmark"></i><code>ti-bookmark</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bookmark-alt"></i><code>ti-bookmark-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-reload"></i><code>ti-reload</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-plus"></i><code>ti-plus</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pin"></i><code>ti-pin</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pencil"></i><code>ti-pencil</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pencil-alt"></i><code>ti-pencil-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-paint-roller"></i><code>ti-paint-roller</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-paint-bucket"></i><code>ti-paint-bucket</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-na"></i><code>ti-na</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-mobile"></i><code>ti-mobile</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-minus"></i><code>ti-minus</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-medall"></i><code>ti-medall</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-medall-alt"></i><code>ti-medall-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-marker"></i><code>ti-marker</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-marker-alt"></i><code>ti-marker-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-up"></i><code>ti-arrow-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-right"></i><code>ti-arrow-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-left"></i><code>ti-arrow-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-down"></i><code>ti-arrow-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-lock"></i><code>ti-lock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-location-arrow"></i><code>ti-location-arrow</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-link"></i><code>ti-link</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout"></i><code>ti-layout</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layers"></i><code>ti-layers</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layers-alt"></i><code>ti-layers-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-key"></i><code>ti-key</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-import"></i><code>ti-import</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-image"></i><code>ti-image</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-heart"></i><code>ti-heart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-heart-broken"></i><code>ti-heart-broken</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-stop"></i><code>ti-hand-stop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-open"></i><code>ti-hand-open</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-drag"></i><code>ti-hand-drag</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-folder"></i><code>ti-folder</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-flag"></i><code>ti-flag</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-flag-alt"></i><code>ti-flag-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-flag-alt-2"></i><code>ti-flag-alt-2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-eye"></i><code>ti-eye</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-export"></i><code>ti-export</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-exchange-vertical"></i><code>ti-exchange-vertical</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-desktop"></i><code>ti-desktop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-cup"></i><code>ti-cup</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-crown"></i><code>ti-crown</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-comments"></i><code>ti-comments</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-comment"></i><code>ti-comment</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-comment-alt"></i><code>ti-comment-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-close"></i><code>ti-close</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-clip"></i><code>ti-clip</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-up"></i><code>ti-angle-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-right"></i><code>ti-angle-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-left"></i><code>ti-angle-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-down"></i><code>ti-angle-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-check"></i><code>ti-check</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-check-box"></i><code>ti-check-box</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-camera"></i><code>ti-camera</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-announcement"></i><code>ti-announcement</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-brush"></i><code>ti-brush</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-briefcase"></i><code>ti-briefcase</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bolt"></i><code>ti-bolt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bolt-alt"></i><code>ti-bolt-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-blackboard"></i><code>ti-blackboard</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bag"></i><code>ti-bag</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-move"></i><code>ti-move</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrows-vertical"></i><code>ti-arrows-vertical</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrows-horizontal"></i><code>ti-arrows-horizontal</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-fullscreen"></i><code>ti-fullscreen</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-top-right"></i><code>ti-arrow-top-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-top-left"></i><code>ti-arrow-top-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-circle-up"></i><code>ti-arrow-circle-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-circle-right"></i><code>ti-arrow-circle-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-circle-left"></i><code>ti-arrow-circle-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrow-circle-down"></i><code>ti-arrow-circle-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-double-up"></i><code>ti-angle-double-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-double-right"></i><code>ti-angle-double-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-double-left"></i><code>ti-angle-double-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-angle-double-down"></i><code>ti-angle-double-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-zip"></i><code>ti-zip</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-world"></i><code>ti-world</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-wheelchair"></i><code>ti-wheelchair</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-view-list"></i><code>ti-view-list</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-view-list-alt"></i><code>ti-view-list-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-view-grid"></i><code>ti-view-grid</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-uppercase"></i><code>ti-uppercase</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-upload"></i><code>ti-upload</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-underline"></i><code>ti-underline</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-truck"></i><code>ti-truck</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-timer"></i><code>ti-timer</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ticket"></i><code>ti-ticket</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-thumb-up"></i><code>ti-thumb-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-thumb-down"></i><code>ti-thumb-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-text"></i><code>ti-text</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-stats-up"></i><code>ti-stats-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-stats-down"></i><code>ti-stats-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-split-v"></i><code>ti-split-v</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-split-h"></i><code>ti-split-h</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-smallcap"></i><code>ti-smallcap</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shine"></i><code>ti-shine</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shift-right"></i><code>ti-shift-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shift-left"></i><code>ti-shift-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shield"></i><code>ti-shield</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-notepad"></i><code>ti-notepad</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-server"></i><code>ti-server</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-quote-right"></i><code>ti-quote-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-quote-left"></i><code>ti-quote-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pulse"></i><code>ti-pulse</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-printer"></i><code>ti-printer</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-power-off"></i><code>ti-power-off</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-plug"></i><code>ti-plug</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pie-chart"></i><code>ti-pie-chart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-paragraph"></i><code>ti-paragraph</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-panel"></i><code>ti-panel</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-package"></i><code>ti-package</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-music"></i><code>ti-music</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-music-alt"></i><code>ti-music-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-mouse"></i><code>ti-mouse</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-mouse-alt"></i><code>ti-mouse-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-money"></i><code>ti-money</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-microphone"></i><code>ti-microphone</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-menu"></i><code>ti-menu</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-menu-alt"></i><code>ti-menu-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-map"></i><code>ti-map</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-map-alt"></i><code>ti-map-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-loop"></i><code>ti-loop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-location-pin"></i><code>ti-location-pin</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-list"></i><code>ti-list</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-light-bulb"></i><code>ti-light-bulb</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-Italic"></i><code>ti-Italic</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-info"></i><code>ti-info</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-infinite"></i><code>ti-infinite</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-id-badge"></i><code>ti-id-badge</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hummer"></i><code>ti-hummer</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-home"></i><code>ti-home</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-help"></i><code>ti-help</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-headphone"></i><code>ti-headphone</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-harddrives"></i><code>ti-harddrives</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-harddrive"></i><code>ti-harddrive</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-gift"></i><code>ti-gift</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-game"></i><code>ti-game</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-filter"></i><code>ti-filter</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-files"></i><code>ti-files</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-file"></i><code>ti-file</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-eraser"></i><code>ti-eraser</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-envelope"></i><code>ti-envelope</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-download"></i><code>ti-download</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-direction"></i><code>ti-direction</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-direction-alt"></i><code>ti-direction-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-dashboard"></i><code>ti-dashboard</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-stop"></i><code>ti-control-stop</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-shuffle"></i><code>ti-control-shuffle</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-play"></i><code>ti-control-play</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-pause"></i><code>ti-control-pause</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-forward"></i><code>ti-control-forward</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-backward"></i><code>ti-control-backward</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-cloud"></i><code>ti-cloud</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-cloud-up"></i><code>ti-cloud-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-cloud-down"></i><code>ti-cloud-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-clipboard"></i><code>ti-clipboard</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-car"></i><code>ti-car</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-calendar"></i><code>ti-calendar</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-book"></i><code>ti-book</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bell"></i><code>ti-bell</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-basketball"></i><code>ti-basketball</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bar-chart"></i><code>ti-bar-chart</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-bar-chart-alt"></i><code>ti-bar-chart-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-back-right"></i><code>ti-back-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-back-left"></i><code>ti-back-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-arrows-corner"></i><code>ti-arrows-corner</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-archive"></i><code>ti-archive</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-anchor"></i><code>ti-anchor</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-align-right"></i><code>ti-align-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-align-left"></i><code>ti-align-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-align-justify"></i><code>ti-align-justify</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-align-center"></i><code>ti-align-center</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-alert"></i><code>ti-alert</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-alarm-clock"></i><code>ti-alarm-clock</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-agenda"></i><code>ti-agenda</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-write"></i><code>ti-write</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-window"></i><code>ti-window</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-widgetized"></i><code>ti-widgetized</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-widget"></i><code>ti-widget</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-widget-alt"></i><code>ti-widget-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-wallet"></i><code>ti-wallet</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-video-clapper"></i><code>ti-video-clapper</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-video-camera"></i><code>ti-video-camera</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-vector"></i><code>ti-vector</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-themify-logo"></i><code>ti-themify-logo</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-themify-favicon"></i><code>ti-themify-favicon</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-themify-favicon-alt"></i><code>ti-themify-favicon-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-support"></i><code>ti-support</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-stamp"></i><code>ti-stamp</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-split-v-alt"></i><code>ti-split-v-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-slice"></i><code>ti-slice</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shortcode"></i><code>ti-shortcode</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shift-right-alt"></i><code>ti-shift-right-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-shift-left-alt"></i><code>ti-shift-left-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ruler-alt-2"></i><code>ti-ruler-alt-2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-receipt"></i><code>ti-receipt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pin2"></i><code>ti-pin2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pin-alt"></i><code>ti-pin-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pencil-alt2"></i><code>ti-pencil-alt2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-palette"></i><code>ti-palette</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-more"></i><code>ti-more</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-more-alt"></i><code>ti-more-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-microphone-alt"></i><code>ti-microphone-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-magnet"></i><code>ti-magnet</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-line-double"></i><code>ti-line-double</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-line-dotted"></i><code>ti-line-dotted</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-line-dashed"></i><code>ti-line-dashed</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-width-full"></i><code>ti-layout-width-full</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-width-default"></i><code>ti-layout-width-default</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-width-default-alt"></i><code>ti-layout-width-default-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-tab"></i><code>ti-layout-tab</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-tab-window"></i><code>ti-layout-tab-window</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-tab-v"></i><code>ti-layout-tab-v</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-tab-min"></i><code>ti-layout-tab-min</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-slider"></i><code>ti-layout-slider</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-slider-alt"></i><code>ti-layout-slider-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-sidebar-right"></i><code>ti-layout-sidebar-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-sidebar-none"></i><code>ti-layout-sidebar-none</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-sidebar-left"></i><code>ti-layout-sidebar-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-placeholder"></i><code>ti-layout-placeholder</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-menu"></i><code>ti-layout-menu</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-menu-v"></i><code>ti-layout-menu-v</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-menu-separated"></i><code>ti-layout-menu-separated</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-menu-full"></i><code>ti-layout-menu-full</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-right-alt"></i><code>ti-layout-media-right-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-right"></i><code>ti-layout-media-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-overlay"></i><code>ti-layout-media-overlay</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-overlay-alt"></i><code>ti-layout-media-overlay-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-overlay-alt-2"></i><code>ti-layout-media-overlay-alt-2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-left-alt"></i><code>ti-layout-media-left-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-left"></i><code>ti-layout-media-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-center-alt"></i><code>ti-layout-media-center-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-media-center"></i><code>ti-layout-media-center</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-list-thumb"></i><code>ti-layout-list-thumb</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-list-thumb-alt"></i><code>ti-layout-list-thumb-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-list-post"></i><code>ti-layout-list-post</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-list-large-image"></i><code>ti-layout-list-large-image</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-line-solid"></i><code>ti-layout-line-solid</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid4"></i><code>ti-layout-grid4</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid3"></i><code>ti-layout-grid3</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid2"></i><code>ti-layout-grid2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid2-thumb"></i><code>ti-layout-grid2-thumb</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-cta-right"></i><code>ti-layout-cta-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-cta-left"></i><code>ti-layout-cta-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-cta-center"></i><code>ti-layout-cta-center</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-cta-btn-right"></i><code>ti-layout-cta-btn-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-cta-btn-left"></i><code>ti-layout-cta-btn-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column4"></i><code>ti-layout-column4</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column3"></i><code>ti-layout-column3</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column2"></i><code>ti-layout-column2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-accordion-separated"></i><code>ti-layout-accordion-separated</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-accordion-merged"></i><code>ti-layout-accordion-merged</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-accordion-list"></i><code>ti-layout-accordion-list</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-ink-pen"></i><code>ti-ink-pen</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-info-alt"></i><code>ti-info-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-help-alt"></i><code>ti-help-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-headphone-alt"></i><code>ti-headphone-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-point-up"></i><code>ti-hand-point-up</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-point-right"></i><code>ti-hand-point-right</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-point-left"></i><code>ti-hand-point-left</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-hand-point-down"></i><code>ti-hand-point-down</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-gallery"></i><code>ti-gallery</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-face-smile"></i><code>ti-face-smile</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-face-sad"></i><code>ti-face-sad</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-credit-card"></i><code>ti-credit-card</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-skip-forward"></i><code>ti-control-skip-forward</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-skip-backward"></i><code>ti-control-skip-backward</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-record"></i><code>ti-control-record</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-control-eject"></i><code>ti-control-eject</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-comments-smiley"></i><code>ti-comments-smiley</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-brush-alt"></i><code>ti-brush-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-youtube"></i><code>ti-youtube</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-vimeo"></i><code>ti-vimeo</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-twitter"></i><code>ti-twitter</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-time"></i><code>ti-time</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-tumblr"></i><code>ti-tumblr</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-skype"></i><code>ti-skype</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-share"></i><code>ti-share</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-share-alt"></i><code>ti-share-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-rocket"></i><code>ti-rocket</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pinterest"></i><code>ti-pinterest</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-new-window"></i><code>ti-new-window</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-microsoft"></i><code>ti-microsoft</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-list-ol"></i><code>ti-list-ol</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-linkedin"></i><code>ti-linkedin</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-sidebar-2"></i><code>ti-layout-sidebar-2</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid4-alt"></i><code>ti-layout-grid4-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid3-alt"></i><code>ti-layout-grid3-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-grid2-alt"></i><code>ti-layout-grid2-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column4-alt"></i><code>ti-layout-column4-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column3-alt"></i><code>ti-layout-column3-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-layout-column2-alt"></i><code>ti-layout-column2-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-instagram"></i><code>ti-instagram</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-google"></i><code>ti-google</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-github"></i><code>ti-github</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-flickr"></i><code>ti-flickr</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-facebook"></i><code>ti-facebook</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-dropbox"></i><code>ti-dropbox</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-dribbble"></i><code>ti-dribbble</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-apple"></i><code>ti-apple</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-android"></i><code>ti-android</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-save"></i><code>ti-save</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-save-alt"></i><code>ti-save-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-yahoo"></i><code>ti-yahoo</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-wordpress"></i><code>ti-wordpress</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-vimeo-alt"></i><code>ti-vimeo-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-twitter-alt"></i><code>ti-twitter-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-tumblr-alt"></i><code>ti-tumblr-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-trello"></i><code>ti-trello</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-stack-overflow"></i><code>ti-stack-overflow</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-soundcloud"></i><code>ti-soundcloud</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-sharethis"></i><code>ti-sharethis</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-sharethis-alt"></i><code>ti-sharethis-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-reddit"></i><code>ti-reddit</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-pinterest-alt"></i><code>ti-pinterest-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-microsoft-alt"></i><code>ti-microsoft-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-linux"></i><code>ti-linux</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-jsfiddle"></i><code>ti-jsfiddle</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-joomla"></i><code>ti-joomla</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-html5"></i><code>ti-html5</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-flickr-alt"></i><code>ti-flickr-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-email"></i><code>ti-email</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-drupal"></i><code>ti-drupal</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-dropbox-alt"></i><code>ti-dropbox-alt</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-css3"></i><code>ti-css3</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-rss"></i><code>ti-rss</code>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                      <div class="preview-icon"><i class="ti-rss-alt"></i><code>ti-rss-alt</code>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection