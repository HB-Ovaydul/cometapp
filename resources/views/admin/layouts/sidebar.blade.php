			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="active"> 
								<a href="index.html"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>
							@if(in_array('Slider', json_decode(Auth::guard('admin')->user()->role->permission)))
							<li> 
								<a href="{{ route('slide.index') }}"><i class="fa fa-sliders"></i> <span>Slider</span></a>
							</li>
							@endif
							@if (in_array('Testimonials', json_decode(Auth::guard('admin')->user()->role->permission)))
							<li> 
								<a href="index.html"><i class="fe fa-quote-right"></i> <span>Testimonials</span></a>
							</li>
							@endif
							@if (in_array('Our Clint', json_decode(Auth::guard('admin')->user()->role->permission)))
							<li> 
								<a href="index.html"><i class="fe fe-user"></i> <span>Our Clints</span></a>
							</li>
							@endif
							@if (in_array('Portfolio', json_decode(Auth::guard('admin')->user()->role->permission)))
                            <li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="invoice-report.html">Portfolio</a></li>
                                    <li><a href="invoice-report.html">Category</a></li>
                                    <li><a href="invoice-report.html">Tags</a></li>
								</ul>
							</li>
							@endif
							@if(in_array('Our Team', json_decode(Auth::guard('admin')->user()->role->permission)))
                            <li> 
								<a href="index.html"><i class="fe fe-users"></i> <span>Our Team</span></a>
							</li>
							@endif

						@if(in_array('Post', json_decode(Auth::guard('admin')->user()->role->permission)))
                            <li class="submenu">
								<a href="#"><i class="fa fa-comment-o"></i> <span> Post</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="invoice-report.html">All Post</a></li>
                                    <li><a href="invoice-report.html">Category</a></li>
                                    <li><a href="invoice-report.html">Tags</a></li>
								</ul>
							</li>
						@endif

                            @if (in_array('User',json_decode(Auth::guard('admin')->user()->role->permission)))
							<li class="submenu">
								<span class="ml-3 text-light">Admin Optoon</span>
								<a href="#"><i class="fe fe-users"></i> <span> Admin User</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('admin-user.index') }}">Users</a></li>
                                    <li><a href="{{ route('role.index') }}">Role</a></li>
                                    <li><a href="{{ route('permission.index') }}">Permission</a></li>
								</ul>
							</li>
							@endif
							@if (in_array('Theme option',json_decode(Auth::guard('admin')->user()->role->permission)))
                            <li> 
								<a href="index.html"><i class="fa fa-etsy"></i> <span>Theme Option</span></a>
							</li>
							@endif

							@if (in_array('Setings',json_decode(Auth::guard('admin')->user()->role->permission)))
                            <li> 
								<a href="index.html"><i class="fa fa-cog"></i> <span>Settings</span></a>
							</li>
							@endif


						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->