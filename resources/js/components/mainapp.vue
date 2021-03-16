<template>
    <div id="app">
        <div>
            <div class="_1side_menu">
                <div class="_1side_menu_logo">
                    <h3 style="text-align:center;"></h3>
                    <img
                        src="/upload/1613099758.png"
                        style="width: 50px;margin-left: 20px;margin-top:30px"
                    />
                </div>

                <div class="_1side_menu_content">
                    <div class="_1side_menu_img_name">
                        <p class="_1side_menu_name">XYZ</p>
                    </div>

                <div class="_1side_menu_list">

                    <section class="sidebar xyz-font-color-brown mt-3" id="sidebar" >
                        <ul class="sidebar-menu ">
                          <li  class="treeview ">
                            <!-- <a href="#" class="xyz-font-color-brown active"> -->
                            <router-link to="/dashboard">
                                <i class="fa fa-book  "></i><span class="xyz-font-family-roboto-slab xyz-font-size-14px">Dashboard</span>
                                <i class="fa fa-angle-left pull-right " ></i>
                               </router-link>
                            <!-- </a> -->
                        </li>

                    <li  class="treeview ">
                        <router-link to="/post">
                            
                                <i class="fa fa-paper-plane "></i><span class="xyz-font-family-roboto-slab xyz-font-size-14px">Posts</span>
                                <i class="fa fa-angle-left pull-right "></i>

                        </router-link>
                        </li>
           
              

                <li  class="treeview" ref="admin_Admin">
                              <router-link to="/comments">
                                <i class="fa fa-comments "></i><span   class="xyz-font-family-roboto-slab xyz-font-size-14px ">Comments</span>
                                <i class="fa fa-angle-left pull-right"></i>
                              </router-link>
                        </li>

            
				<li  class="treeview " >
                              <router-link to="/albums">
                                <i class="fa fa-folder "></i><span class ="xyz-font-family-roboto-slab xyz-font-size-14px" >Albums</span>
                                <i class="fa fa-angle-left pull-right "></i>
                              </router-link>
                        </li>
				<li  class="treeview " >
                             <router-link to="/photo">
                                <i class="fa fa-picture-o "></i><span class ="xyz-font-family-roboto-slab xyz-font-size-14px">Photos</span>
                                <i class="fa fa-angle-left pull-right "></i>
                             </router-link>
                         </li>

				<li  class="treeview " >
                             <router-link to="/todos">
                                <i class="fa fa-list "></i><span class ="xyz-font-family-roboto-slab xyz-font-size-14px">Todos</span>
                                <i class="fa fa-angle-left pull-right " ></i>
                             </router-link>
                         </li>
					<li  class="treeview " >
						 <router-link to="/users">
							<i class="fa fa-user "></i><span class ="xyz-font-family-roboto-slab xyz-font-size-14px" >Users</span>
							<i class="fa fa-angle-left pull-right " ></i>
                         </router-link>
					</li>

                                             
                 </ul>
    </section>  
                    </div>
                </div>
            </div>

        </div>
        <router-view />
    </div>
</template>

<style  scoped>
*{
	margin:0;
	padding: 0;
}



.sidebar .sidebar-menu
{
	list-style-type: none;
	padding: 0;
	margin:0;
}

.sidebar .sidebar-menu >li
{
	margin:0;
	padding: 0;
}

.sidebar .sidebar-menu > li > a {
  padding: 12px 5px 12px 15px;
  display: block;
}

.sidebar .sidebar-menu > li > a > .fa,
.sidebar .sidebar-menu > li > a > .glyphicon,
.sidebar .sidebar-menu > li > a > .ion {
  width: 20px;
}


.xyz-color .sidebar > .sidebar-menu > li:first-of-type > a {
  border-top: 1px solid #fff;
}
.xyz-color .sidebar > .sidebar-menu > li > a:hover,
.xyz-color .sidebar > .sidebar-menu > li.active > a {
  color: white;
  background-color:#3c8dbc !important;
  transition: ease-out 250ms;
}

.xyz-color .sidebar > .sidebar-menu > li > a:hover
{
	color:white !important;
}
.sidebar .sidebar-menu {
    box-shadow: 0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
    border: none;
    background: #FFF;
}

.sidebar .sidebar-menu .treeview > a
{
	text-decoration: none;
	color: #000;
}
.sidebar .sidebar-menu .treeview a > i
{
	margin-right: 20px;
	margin-left: 5px;
}





/*colors  */
.xyz-color-olive
{
	background-color:#3c8dbc !important;
}

.xyz-color-blue
{
	 background-color: rgb(92,184,92) !important;
}
.xyz-font-color-white
{
	color:#f3f3f3 !important;
}

.xyz-font-color-black
{
	color:#000 !important;
}

.xyz-color-orange-light
{
	background-color: #fbce94 !important;
}
.xyz-color-green
{
	background-color: #01ff70 !important;
}

.xyz-color-teal
{
	background-color: #39cccc !important;
}
.xyz-color-orange
{
	background-color: #ff851b !important;
}
.xyz-color-purple
{
	 background-color: #f012be !important;
}

.xyz-color-white
{
	background-color: #f3f3f3;
}
/*font family */
.xyz-font-family-anton
{
	font-family: 'Anton', sans-serif;
}

.xyz-font-family-courier
{
	font-family: 'Pacifico',sans-serif;
}

.xyz-font-family-verdana
{
	font-family: verdana;
}
.xyz-font-color-brown
{
	color:#6a5f56 !important;
}
.xyz-font-weight-300
{
	font-weight: 300;
}
.xyz-font-weight-600
{
	font-weight: 600;
}
/*font-size */
.xyz-font-size-16px
{
	font-size: 16px !important;
}
.xyz-font-size-14px
{
	font-size:14px !important;
}
.xyz-font-size-10px
{
	font-size: 10px !important;
}
.xyz-font-size-12px
{
	font-size: 12px !important;
}

.xyz-font-size-32px
{
	font-size: 32px !important;
}
.xyz-font-size-24px
{
	font-size: 24px !important;
}
.active
{
	background-color:#3c8dbc !important;
	color:white !important;
}
/*padding */
.xyz-padding-16px
{
	padding:16px !important;
}


</style>