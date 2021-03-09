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
                        <p class="_1side_menu_name">Jes</p>
                    </div>

                    <div class="_1side_menu_list">
                        <ul class="_1side_menu_list_ul">
                            <li>
                                <router-link to="/dashboard"
                                    ><Icon type="md-podium" /> DASHBOARD
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/tags"
                                    ><Icon type="md-flag" /> TAGS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/category"
                                    ><Icon type="md-paper" /> CATEGORY
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/reports"
                                    ><Icon type="ios-list-box-outline" /> REPORTS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/records"
                                    ><Icon type="ios-browsers" /> RECORDS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/certificates"
                                    ><Icon type="ios-paper" /> CERTIFICATES
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/officials"
                                    ><Icon type="ios-body" /> OFFICIALS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/events"
                                    ><Icon type="ios-game-controller-b" /> EVENTS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/batch"
                                    ><Icon type="ios-folder" /> BATCH
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/announcements"
                                    ><Icon type="ios-megaphone" /> ANNOUNCEMENTS
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/about"
                                    ><Icon type="ios-person" /> ABOUT
                                </router-link>
                            </li>
                               <li>
                                <a href="/"><Icon type="ios-log-out" /> SIGN OUT
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header">
                <div class="_2menu _box_shadow">
                    <div class="_2menu_logo">
                        <ul class="open_button">
                            <li>
                                <Icon type="ios-list" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <router-view />
    </div>
</template>
