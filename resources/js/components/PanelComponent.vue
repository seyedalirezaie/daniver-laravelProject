<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">

    <div>

        <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 px-0">


            <div class="ui-block">
                <div class="top-header">
                    <div class="top-header-thumb">
                        <img :src="userHeaderPath" alt="تصویر زمینه پروفایل" title="تصویر زمینه پروفایل">
                        <div v-if="flag_headerUploading" class="dark-on-header">
                        </div>
                        <div v-if="flag_headerUploading" class="hollow-dots-spinner loader-panel" :style="spinnerStyle">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </div>

                    </div>
                    <div class="profile-section">
                        <div class="row justify-content-end pr-5">
                            <span class="fs1 fw-700">{{user.family}} <span class="fs1 fw-400">({{user.alias_original}})</span></span>
                        </div>

                        <div class="control-block-button" @click="changeHeaderImage()" data-toggle="modal" data-target="#edit-widget-pool">
                            <div class="btn btn-control bg-blue more">
                                <i class="fas fa-images text-white"></i>
                                <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                    <li>
                                        <span class="text-grey">تغییر تصویر زمینه</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div v-if="flag_hasHeaderImage" class="control-block-button btn-delete-header" @click="deleteHeaderImage()">
                            <div class="btn btn-control bg-primary more">
                                <i class="fas fa-eraser text-white"></i>
                                <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                    <li>
                                        <span class="text-grey">حذف تصویر زمینه</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="top-header-author profile-header-info">
                        <div class="control-block-button btn-change-avatar" @click="changeProfileImage()" data-toggle="modal" data-target="#edit-widget-pool">
                            <div class="btn btn-control bg-blue more">
                                <i class="fas fa-image text-white"></i>
                                <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                    <li>
                                        <span class="text-grey">تغییر تصویر پروفایل</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div v-if="flag_hasProfileImage" class="control-block-button btn-delete-profile" @click="deleteProfileImage()">
                            <div class="btn btn-control bg-primary more">
                                <i class="fas fa-eraser text-white"></i>
                                <ul class="more-dropdown more-with-triangle triangle-bottom-right bg-white">
                                    <li>
                                        <span class="text-grey">حذف تصویر پروفایل</span>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <a href="02-ProfilePage.html" class="author-thumb">
                            <img v-if="!flag_profileChanged" :src="user.path_md" :alt="user.family" :title="user.family">
                            <img v-else :src="userProfilePath" :alt="user.family" :title="user.family">
                            <div v-if="flag_ProfileUploading" class="dark-on-header">
                            </div>
                            <div v-if="flag_ProfileUploading" class="hollow-dots-spinner loader-panel profile-panel" :style="spinnerStyle">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </a>




                    </div>
                </div>
            </div>
        </div>



        <div dir="rtl" class="modal fade" id="edit-widget-pool" tabindex="-1" role="dialog" aria-labelledby="edit-widget-pool" aria-hidden="true">
            <div class="modal-dialog window-popup edit-widget edit-widget-pool modal-change-avatar" role="document">
                <div class="modal-content">
                    <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                        <svg class="olymp-close-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
                    </a>

                    <div class="modal-header">
                        <h6 v-if="flag_changeProfileImage" class="title">تعیین تصویر پروفایل</h6>
                        <h6 v-if="flag_changeHeaderImage" class="title">تعیین تصویر زمینه</h6>
                    </div>

                    <div class="modal-body">


                        <div class="text-center">

                            <input type="range" @input="onSliderChange" :min="sliderMin" :max="sliderMax" step=".001" v-model="sliderVal">

                            <croppa v-if="flag_changeProfileImage" @file-choose="handleFileChoose" @zoom="onZoom"  v-model="croppa" @new-image-drawn="onNewImage"
                                    :placeholder="'تصویر را انتخاب کنید'"
                                    :placeholder-font-size="14"
                                    :accept="'image/*'"
                                    :file-size-limit="0"
                                    :prevent-white-space="true"
                                    :width="180"
                                    :height="180"
                                    :quality="1.2">
                                ></croppa>

                            <croppa v-if="flag_changeHeaderImage" @file-choose="handleFileChoose" @zoom="onZoom"  v-model="croppa" @new-image-drawn="onNewImage"
                                    :placeholder="'تصویر را انتخاب کنید'"
                                    :placeholder-font-size="14"
                                    :accept="'image/*'"
                                    :file-size-limit="0"
                                    :prevent-white-space="true"
                                    :width="768"
                                    :height="256"
                                    :quality="1.2">
                                ></croppa>

                        </div>



                        <div class="text-center mt-3">
                            <span v-if="flag_changeHeaderImage" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-green full-width d-inline-block w-25" @click="setHeaderImage()">ثبت تصویر</span>
                            <span v-if="flag_changeProfileImage" data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-green full-width d-inline-block w-25" @click="setProfileImage()">ثبت تصویر</span>
                            <span data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary full-width d-inline-block w-25">لغو</span>
                        </div>
                        </div>


                    </div>
                </div>
            </div>



        <div class="container-fluid px-0" dir="rtl">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">

                    <!--<div v-show="flag_tabs['dashboard']" class="ui-block">
                        <div class="ui-block-title">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                میز کار
                            </div>
                        </div>
                        <div class="ui-block-content">

                        </div>

                    </div>-->


                    <div v-show="flag_tabs['personal']" class="ui-block">
                        <div class="ui-block-title">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                اطلاعات شخصی
                            </div>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">* نام
                                        <span v-show="errors.has('name')" class="text-primary">{{ errors.first('name') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" v-validate="'required'" name="name" class="form-control" placeholder="" type="text" v-model="reg_name">
                                    <span class="material-input"></span></div>

                            </div>

                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">* نام خانوادگی
                                        <span v-show="errors.has('last_name')" class="text-primary">{{ errors.first('last_name') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" v-validate="'required'" name="last_name" class="form-control" placeholder="" type="text" value="Spiegel" v-model="reg_lastName">
                                    <span class="material-input"></span></div>

                                <div class="form-group date-time-picker label-floating date-select-container">
                                    <label class="control-label mr-4">تاریخ تولد</label>
                                    <div>
                                        <date-picker
                                                v-model="birthday"
                                                format="YYYY-MM-DD HH:mm:ss"
                                                view="year"
                                                display-format="dddd jDD jMMMM jYYYY">
                                        </date-picker>
                                    </div>
                                </div>

                            </div>

                            <!--<div class="container-fluid">
                                <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">-->
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">نام مستعار
                                        <span v-if="aliasUniqueError" class="text-primary fs0-6">(این نام مستعار قبلا توسط کاربر دیگری ثبت شده است)</span>
                                    </label>
                                    <input v-model="reg_alias" class="form-control" placeholder="" type="text" value="James">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating">
                                    <label class="control-label">شماره موبایل</label>
                                    <input v-model="reg_phone" class="form-control" placeholder="" type="text">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 20" class="control-label">جنسیت</label>
                                    <v-select v-model="v_gender" dir="rtl" :searchable=false :value.sync="selected" :options=genderArray @search:blur="selectUnFocus()" @search:focus="selectFocus(20)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <!--</div>
                           </div>
                       </div>-->

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                محل سکونت خانواده(منظور محل سکونت دانشجویی نیست)
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <span v-bind:class="{'line-deleted-item' : flag_liveChanged}" v-if="oldProvince !== null">{{oldProvince}}</span>
                                <span v-bind:class="{'line-deleted-item' : flag_liveChanged}" v-if="oldCity !== null" class="mr-2"> {{oldCity}}</span>
                                <span v-bind:class="{'line-deleted-item' : flag_liveChanged}" v-if="oldSubCity !== null" class="mr-2"> {{oldSubCity}}</span>
                                <span v-bind:class="{'line-deleted-item' : flag_liveChanged}" v-if="oldCountry !== null">{{oldCountry}}</span>
                                <span @click="changeCity()" class="btn btn-sm btn-gold mt-3 mr-2">جدید</span>
                                <span @click="deleteCity('live')" class="btn btn-sm btn-primary mt-3 mr-3">حذف</span>
                            </div>

                            <div v-if="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 1" class="control-label">استان محل زندگی</label>
                                    <v-select v-bind:disabled="v_liveForeign" @input="showCities()" v-model="v_province" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(1)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div v-if="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 2" class="control-label">شهرستان محل زندگی</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" @input="showSubCities()" v-model="v_city" dir="rtl" :searchable=true :value.sync="selected" :options=cities @search:blur="selectUnFocus()" @search:focus="selectFocus(2)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-if="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 3" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" v-model="v_subCity" dir="rtl" :searchable=true :value.sync="selected" :options=subCities @search:blur="selectUnFocus()" @search:focus="selectFocus(3)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-if="flag_changeCity" class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <input v-model="v_liveForeign" class="d-inline-block input-width-unset" type="checkbox">
                                <span class="mb-3">خارج از کشور</span>

                                <div v-if="v_liveForeign" class="form-group label-floating mt-3">
                                    <label class="control-label">نام کشور محل سکونت خانواده خود را وارد کنید</label>
                                    <input class="form-control" placeholder="" type="text" v-model="reg_liveForeign">
                                    <span class="material-input"></span></div>

                            </div>

                            <!--end province city-->


                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                زادگاه
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <span v-bind:class="{'line-deleted-item' : flag_birthChanged}" v-if="oldBirthProvince !== null">{{oldBirthProvince}}</span>
                                <span v-bind:class="{'line-deleted-item' : flag_birthChanged}" v-if="oldBirthCity !== null" class="mr-2"> {{oldBirthCity}} </span>
                                <span v-bind:class="{'line-deleted-item' : flag_birthChanged}" v-if="oldBirthSubCity !== null" class="mr-2"> {{oldBirthSubCity}} </span>
                                <span v-bind:class="{'line-deleted-item' : flag_birthChanged}" v-if="oldBirthCountry !== null">{{oldBirthCountry}} </span>
                                <span @click="changeBirthCity()" class="btn btn-sm btn-gold mt-3 mr-2">جدید</span>
                                <span @click="deleteCity('birth')" class="btn btn-sm btn-primary mt-3 mr-3">حذف</span>
                            </div>

                            <div v-if="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==17" class="control-label">استان</label>
                                    <v-select v-bind:disabled="v_fromForeign" @input="showCities('born')" v-model="v_provinceBorn" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(17)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div v-if="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==18" class="control-label">شهرستان</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" @input="showSubCities('born')" v-model="v_cityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=citiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(18)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-if="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 19" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" v-model="v_subCityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=subCitiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(19)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-if="flag_changeBirthCity" class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <input v-model="v_fromForeign" class="d-inline-block input-width-unset" type="checkbox">
                                <span class="mb-3">خارج از کشور</span>

                                <div v-if="v_fromForeign" class="form-group label-floating mt-3">
                                    <label class="control-label">نام کشور محل تولد خود را وارد کنید</label>
                                    <input v-model="v_foreignBirthPlace" class="form-control" placeholder="" type="text" value="James">
                                    <span class="material-input"></span></div>

                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3 mt-4 bg-grey-title rounded p-3">
                                مدارس دوران تحصیل
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">ابتدایی</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school1">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating">
                                    <label class="control-label">راهنمایی</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school2">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating">
                                    <label class="control-label">دبیرستان</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school3">
                                    <span class="material-input"></span></div>
                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green" @click="submitPersonalInformation()">اعمال تغییرات</span>
                            <span class="btn btn-primary mr-2">لغو تغییرات</span>
                        </div>

                    </div>

                    <div v-show="flag_tabs['educational']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">اطلاعات دانشجویی</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">

                                <h6 class="bg-grey-title p-3 rounded">وضعیت تحصیلی</h6>
                                <br/>
                                <br/>
                                <span class="fs0-75 mt-3 mb-3">توجه: به دلیل برخی مسائل تغییر لحظه ای رشته تحصیلی و دیگر اطلاعات مربوط به آن امکان پذیر نیست. در صورتی که می خواهید این اطلاعات را تغییر دهید با پر کردن دقیق فرم باز شده درخواست خود را برای تغییر اطلاعات ارسال فرمایید.</span>
                                <br/>
                                <br/>
                                <div class="form-group label-floating">
                                    <label class="control-label">مثال:دانشکده فنی و مهندسی، رشته مهندسی برق - کارشناسی - ورودی 1397 - در حال تحصیل</label>
                                    <textarea class="form-control" v-model="v_editEducationRequest"></textarea>
                                    <span class="material-input"></span>

                                </div>

                                <br/>
                                <h6 class="mt-3 bg-grey-title p-3 rounded">وضعیت سکونت دانشجویی</h6>
                                <br/>
                                <br/>
                                <span class="fs0-75 mt-3 mb-3">توجه کنید که برای شرکت در گروه های خوابگاهی لازم است خوابگاه خود را ثبت کنید. با این کار نام شما به صورت خودکار در گروه خوابگاهی مورد نظر قرار خواهد گرفت</span>
                                <br/>
                                <br/>
                                <div class="form-group">
                                    <input value="rafsanjan" name="dorm-type" v-model="dormStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>اهل رفسنجان هستم و با خانواده زندگی می کنم.</span>
                                </div>

                                <div class="form-group">
                                    <input value="dorm-vru" name="dorm-type" v-model="dormStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>در خوابگاه دانشجویی دانشگاه سکونت دارم</span>
                                </div>

                                <div class="form-group">
                                    <input value="dorm-other" name="dorm-type" v-model="dormStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>در خوابگاه دانشجویی دیگر سکونت دارم</span>
                                </div>

                                <div class="form-group">
                                    <input value="home-dorm" name="dorm-type" v-model="dormStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>در خانه دانشجویی سکونت دارم</span>
                                </div>


                                <div v-if="dormStatus === 'dorm-vru'" class="col col-lg-4 col-md-4 col-sm-10 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label v-if="flag_titleShow !==16" class="control-label">خوابگاه دانشجویی را انتخاب کنید</label>
                                        <v-select label="titles" v-model="v_dorm" dir="rtl" :searchable=true :value.sync="selected" :options=dorms @search:blur="selectUnFocus()" @search:focus="selectFocus(16)"></v-select>
                                        <span class="material-input"></span></div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green" @click="submitEducationInformation()">اعمال تغییرات</span>
                            <span class="btn btn-primary mr-2" @click="cancelEducationInformation()">لغو تغییرات</span>
                        </div>

                    </div>



                    <div v-show="flag_tabs['hobbies']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">علایق و مهارت ها</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-12">



                                <div>
                                    <label class="control-label">توضیح کوتاهی در مورد خودتان بنویسید</label>
                                    <div v-html="v_selfDescription" contenteditable="true" class="div-textarea rounded self-description"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">کتاب های مورد علاقه؟</label>
                                    <div v-html="v_favorites_book" contenteditable="true" class="div-textarea rounded favorite-books"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">سایر چیزها و کارهای مورد علاقه؟</label>
                                    <div v-html="v_favorites" contenteditable="true" class="div-textarea rounded favorites"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">رزومه، سوابق، شغل و ...</label>
                                    <div v-html="cv" contenteditable="true" class="div-textarea rounded user-cv"></div>
                                </div>


                            </div>
                            <div class="col col-lg-9 col-md-9 col-sm-12 col-12">

                                <div class="mt-5">
                                    <label class="control-label">موسیقی، آهنگ و خواننده مورد علاقه؟</label>
                                    <div v-html="v_favorites_music" contenteditable="true" class="div-textarea rounded favorite-musics"></div>
                                </div>


                                <div class="mt-5">
                                    <label class="control-label">فیلم سینمایی و سریال مورد علاقه؟</label>
                                    <div v-html="v_favorites_movie" contenteditable="true" class="div-textarea rounded favorite-movies"></div>
                                </div>


                                <div class="mt-5">
                                    <label class="control-label">مهارت های فنی، هنری، علمی و ...</label>
                                    <div v-html="v_skills" contenteditable="true" class="div-textarea rounded favorite-skills"></div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green" @click="submitHobbiesInformation()">اعمال تغییرات</span>
                            <span class="btn btn-primary mr-2" @click="cancelHobbiesInformation()">لغو تغییرات</span>
                        </div>

                    </div>


                    <div v-show="flag_tabs['social_networks']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">شبکه های اجتماعی</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس حساب تلگرام شما</label>
                                    <input v-model="account_telegram" class="form-control" type="text">
                                    <i class="fab fa-telegram-plane text-blue"></i>
                                    <span class="material-input"></span></div>

                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس حساب اینستاگرام شما</label>
                                    <input v-model="account_instagram" class="form-control" type="text">
                                    <i class="fab fa-instagram text-primary"></i>
                                    <span class="material-input"></span></div>

                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس حساب لینکدین شما</label>
                                    <input v-model="account_linkedin" class="form-control" type="text">
                                    <i class="fab fa-linkedin-in"></i>
                                    <span class="material-input"></span></div>

                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس ایمیل شما</label>
                                    <input v-model="account_email" class="form-control" type="text">
                                    <i class="fas fa-at text-red"></i>
                                    <span class="material-input"></span></div>

                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس حساب فیسبوک شما</label>
                                    <input v-model="account_facebook" class="form-control" type="text">
                                    <svg class="svg-inline--fa fa-facebook-f fa-w-9 c-facebook" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" data-fa-i2svg=""><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg><!-- <i class="fab fa-facebook-f c-facebook" aria-hidden="true"></i> -->
                                    <span class="material-input"></span></div>
                                <div class="form-group with-icon label-floating">
                                    <label class="control-label">آدرس حساب توییتر شما</label>
                                    <input v-model="account_twitter" class="form-control" type="text">
                                    <svg class="svg-inline--fa fa-twitter fa-w-16 c-twitter" aria-hidden="true" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter c-twitter" aria-hidden="true"></i> -->
                                    <span class="material-input"></span></div>
                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green" @click="submitAccountsEdit()">اعمال تغییرات</span>
                            <span class="btn btn-primary mr-2"  @click="cancelAccountsEdit()">لغو تغییرات</span>
                        </div>

                    </div>

                    <div v-show="flag_tabs['change_password']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">تغییر رمز عبور</h6>
                        </div>
                        <div class="ui-block-content">

                                <div class="form-group label-floating">
                                    <label class="control-label"> رمز عبور جدید
                                        <span v-show="errors.has('password')" class="help is-danger text-primary">{{ errors.first('password') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" ref="password" v-validate="'required|min:6'" name="password" class="form-control" placeholder="" type="password" v-model="reg_password">
                                    <span class="material-input"></span></div>

                            <div class="form-group label-floating">
                                <label class="control-label">* تکرار رمز عبور
                                    <span v-show="errors.has('password_confirmation')" class="help is-danger text-primary">{{ errors.first('password_confirmation') }}</span>
                                </label>
                                <input :class="{'bg-required-field' : flag_justRequiredFields}" data-vv-as="password" v-validate="'required|confirmed:password'" name="password_confirmation" v-model="reg_cPassword" class="form-control" placeholder="" type="password">
                                <span class="material-input"></span></div>

                            </div>



                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green" @click="submitPasswordEdit()">اعمال تغییرات</span>
                            <span class="btn btn-primary mr-2" @click="cancelPasswordEdit()">لغو تغییرات</span>
                        </div>

                    </div>


                    <div v-show="flag_tabs['posts']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">پست ها</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-0">

                                <div class="container profile-posts">
                                    <div class="row justify-content-start" dir="rtl">
                                        <div v-for="(post , index) in user.posts" v-if="index < postItems" class="col col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <div class="ui-block">


                                                <!-- Post -->

                                                <article class="hentry blog-post multiple-posts-profile">

                                                    <a target="_blank" v-if="post.category.sort === 'major'" :href="'/study/posts/'+post.category.slug+'/'+post.slug">
                                                        <div class="post-thumb">
                                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                                            <img v-else width="163" height="163" :src="avatars['post_profile']" :alt="post.title" :title="post.title">

                                                            <span class="post-category bg-blue-light fs0-7">درس و بحث
                                            <span class="sub-category">
                                                <span class="bg-primary">{{post.category.titles}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>
                                        </span>
                                                        </div>
                                                    </a>
                                                    <a v-if="post.category.sort === 'dorm'" :href="'/dormitory/posts/'+post.category.slug+'/'+post.slug">
                                                        <div class="post-thumb">
                                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                                            <img v-else width="163" height="163" :src="avatars['post_profile']" :alt="post.title" :title="post.title">

                                                            <span class="post-category fs0-7 bg-primary">خوابگاه ها

                                            <span class="sub-category">
                                                <span class="bg-blue">{{post.category.title}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>
                                            </span>
                                                        </div>
                                                    </a>
                                                    <a v-if="post.category.sort === 'mate'" :href="'/classmates/posts/'+post.category.slug+'/'+post.slug">
                                                        <div class="post-thumb">
                                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[0].path" :alt="post.title" :title="post.title">
                                                            <img v-else width="163" height="163" :src="avatars['post_profile']" :alt="post.title" :title="post.title">

                                                            <span class="post-category fs0-7 bg-green">هم کلاسی ها

                                                                <span class="sub-category">
                                                <span class="bg-blue">{{post.category.title}}</span>
                                                <span v-if="post.is_guest === 1" class="bg-danger">مهمان</span>
                                            </span>

                                            </span>
                                                        </div>
                                                    </a>

                                                    <a v-if="post.category.sort === 'blog'" :href="'/blog/'+post.category.slug+'/'+post.slug">
                                                        <div class="post-thumb">
                                                            <img width="163" height="163" v-if="post.photos.length > 0" :src="'/images/sm/'+post.photos[post.photos.length - 1].path" :alt="post.title" :title="post.title">
                                                            <img v-else width="163" height="163" :src="avatars['post_profile']" :alt="post.title" :title="post.title">

                                                            <span class="post-category fs0-7 bg-green">وبلاگ
                                            <span class="sub-category bg-blue">{{post.category.title}}</span>
                                            </span>
                                                        </div>
                                                    </a>

                                                    <div class="post-content">

                                                        <a href="#" class="h6 post-title">{{post.title}}</a>

                                                        <div class="author-date">
                                                            <div class="post__date">
                                                                <time class="published  bg-grey-small rounded p-1" datetime="2017-03-24T18:18">
                                                                    {{post.date}}
                                                                </time>
                                                            </div>
                                                        </div>

                                                        <div class="post-additional-info inline-items">


                                                            <div class="comments-shared">
                                                                <a href="#" class="post-add-icon inline-items">
                                                                    <i class="far fa-comments fs1-3"></i>
                                                                    <span>{{post.comments_count}}</span>
                                                                </a>
                                                            </div>

                                                            <div class="comments-shared">
                                                                <a href="#" class="post-add-icon inline-items">
                                                                    <i class="far fa-heart fs1-3"></i>
                                                                    <span>{{post.likes_count}}</span>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </article>

                                                <!-- ... end Post -->
                                            </div>
                                        </div>
                                        <div v-if="flag_hasMore" class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 order-3 text-center p-2">
                                            <div v-on:click="showMorePosts()" class="btn btn-lg btn-green p-2 btn-more-posts">بیشتر

                                                <span class="fs0-85 mr-3">(باقی مانده : {{user.posts.length - postItems}})</span>

                                                <div class="inline-items loader-container py-2 posts-loader">
                                                    <div v-show="flag_loader" class="spring-spinner">
                                                        <div class="spring-spinner-part top">
                                                            <div class="spring-spinner-rotator"></div>
                                                        </div>
                                                        <div class="spring-spinner-part bottom">
                                                            <div class="spring-spinner-rotator"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div v-show="flag_tabs['friends']" class="ui-block">
                    <div class="ui-block-title">
                        <h6 class="title bg-grey-title p-3 rounded">دوستان</h6>
                    </div>
                    <div class="ui-block-content">

                        <friends-list-component :profile_user="user" :avatars="avatars" type="panel"></friends-list-component>

                    </div>

                </div>

                    <div v-show="flag_tabs['notifications']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">اعلان ها</h6>
                        </div>
                        <div class="ui-block-content">


                            <div class="more-with-triangle triangle-top-center" dir="rtl">

                                <div class="ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="50eac76a-25e9-1ba0-4544-43ce8da59774">
                                    <ul class="notification-list" v-if="notifications2.length > 0">

                                        <li v-for="(notification , index) in notifications2" v-if="notification.commentable_id && index<notificationItems" class="with-comment-photo">
                                            <div class="author-thumb img-alerts-container">
                                                <img class="img-circle-60 p-2 pt-0" :src="notification.user.path_sm" :alt="notification.user.family" :title="notification.user.family">
                                            </div>
                                            <div class="notification-event">
                                                <div v-if="notification.is_answer"><a :href="'/profile/'+notification.user.url" class="notification-friend fs0-75">{{notification.user.family}}</a> یک پاسخ برای نظر شما در <a :href="notification.commentable.category.url+'/posts/'+notification.commentable.category.slug+'/'+notification.commentable.slug" class="notification-link mx-1">پست {{notification.commentable.title}}</a>ارسال کرد.</div>
                                                <div v-else><a :href="'/profile/'+notification.user.url" class="notification-friend fs0-75">{{notification.user.family}}</a> یک نظر تازه برای <a :href="notification.commentable.category.url+'/posts/'+notification.commentable.category.slug+'/'+notification.commentable.slug" class="notification-link"> پست {{notification.commentable.title}}</a> شما ارسال کرد.</div>
                                                <span class="notification-date ml-1"><time class="entry-date updated">{{notification.full_date}}</time></span>
                                            </div>
                                            <span class="notification-icon">
                                            <i class="far fa-comments fs1-3"></i>
									</span>

                                            <div class="comment-photo alert-description">
                                                <div class="fs0-8 p-1 comment-preview" v-html="notification.description"></div>
                                            </div>

                                            <span v-if="notification.seens.length === 0" class="unseen-notify text-danger" v-bind:class="{'alert-light-border unread-notification' : notification.seens.length === 0}">
                                                جدید
                                            </span>

                                        </li>

                                        <li v-else-if="notification.mentionable_id && index<notificationItems" class="with-comment-photo">
                                            <div class="author-thumb img-alerts-container">
                                                <img class="img-circle-60 p-2 pt-0" :src="notification.mentionable.user.path_sm" :alt="notification.mentionable.user.family" :title="notification.mentionable.user.family">
                                            </div>
                                            <div class="notification-event">
                                                <div v-if="notification.mentionable_type === 'App\\Post'"><a :href="'/profile/'+notification.mentionable.user.url" class="notification-friend fs0-75">{{notification.mentionable.user.family}}</a> شما را در <a :href="notification.mentionable.category.url+'/posts/'+notification.mentionable.category.slug+'/'+notification.mentionable.slug" class="notification-link mx-1">پست {{notification.mentionable.title}}</a>خود تگ کرد.</div>
                                                <div v-if="notification.mentionable_type === 'App\\Comment'"><a :href="'/profile/'+notification.mentionable.user.url" class="notification-friend fs0-75">{{notification.mentionable.user.family}}</a> شما را در یک نظر در <a :href="notification.mentionable.commentable.category.url+'/posts/'+notification.mentionable.commentable.category.slug+'/'+notification.mentionable.commentable.slug" class="notification-link mx-1">پست {{notification.mentionable.commentable.title}}</a>تگ کرد.</div>
                                                <span class="notification-date"><time class="entry-date updated">{{notification.full_date}}</time></span>
                                            </div>
                                            <span class="notification-icon">
										<i class="fas fa-tag ml-1"></i>
									</span>

                                            <span v-if="notification.seens.length === 0" class="unseen-notify text-danger" v-bind:class="{'alert-light-border unread-notification' : notification.seens.length === 0}">
                                                جدید
                                            </span>

                                        </li>

                                        <li v-else-if="notification.accepted && index<notificationItems" class="with-comment-photo">
                                            <div class="author-thumb img-alerts-container">
                                                <img class="img-circle-60 p-2 pt-0" :src="notification.receiver.path_sm" :alt="notification.receiver.family" :title="notification.receiver.family">
                                            </div>
                                            <div class="notification-event">
                                                <div><a :href="'/profile/'+notification.receiver.url" class="notification-friend fs0-75">{{notification.receiver.family}}</a> درخواست دوستی شما پذیرفت.</div>
                                                <span class="notification-date"><time class="entry-date updated">{{notification.full_date}}</time></span>
                                            </div>
                                            <span class="notification-icon">
										<i class="fas fa-check-circle ml-1 text-green"></i>
									</span>

                                            <span class="unseen-notify text-danger" v-bind:class="{'alert-light-border unread-notification' : notification.seens.length === 0}">
                                                جدید
                                            </span>

                                        </li>

                                    </ul>
                                    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                                <span v-show="flag_showMoreNotifications" @click="moreNotifications()" class="view-all bg-purple cursor-pointer">نمایش موارد بیشتر</span>
                            </div>


                        </div>

                    </div>

                    <div v-show="flag_tabs['messages']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">پیام ها</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">

                                        <div @click="selectChat(audience.audience_id)" v-for="audience in audienceMessages" class="ui-block cursor-pointer mb-2 audience-container" dir="rtl">
                                            <div class="birthday-item inline-items badges messages-items">
                                                <div class="author-thumb">
                                                    <img class="img-circle-35" :src="audience[0].audience.path_sm" alt="author">
                                                    <div v-if="audience.unseen_items !== 0" class="label-avatar bg-primary">{{audience.unseen_items}}</div>
                                                </div>
                                                <div class="birthday-author-name">
                                                    <span class="author-name">{{audience[0].audience.family}}</span>
                                                    <div class="birthday-date fs0-7 text-grey-custom">{{audience.last_action}}</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">

                                        <div class="ui-block popup-chat w-100">
                                            <div class="ui-block-title" v-if="selectedChatArray.audience_id">
                                                <span class="icon-status online"></span>
                                                <img class="img-circle-30" :src="selectedChatArray[0].audience.path_sm" :alt="selectedChatArray[0].audience.family" :title="selectedChatArray[0].audience.family">
                                                <h6 class="title">{{selectedChatArray[0].audience.family}}</h6>
                                                <div class="more">
                                                    <svg class="olymp-three-dots-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                                    <svg class="olymp-little-delete"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
                                                </div>
                                            </div>
                                            <div class="messages-scroll mCustomScrollbar ps ps--theme_default ps--active-y" data-mcs-theme="dark" data-ps-id="e85eb408-3ff5-526d-87ab-1b87b470467b">
                                                <ul class="notification-list chat-message chat-message-field" v-if="selectedChatArray.audience_id">
                                                    <li v-for="message in selectedChatArray" v-if="selectedChatArray.audience_id === message.sender_id">
                                                        <div class="author-thumb float-right">
                                                            <img class="img-circle-30" :src="message.sender.path_sm" :alt="message.sender.family" :title="message.sender.family">
                                                        </div>
                                                        <div class="notification-event pl-0 pr-2">
                                                            <div class="w-100 float-right">
                                                            <div v-html="message.description" class="chat-message-item float-right bg-secondary text-white"></div>
                                                            </div>
                                                            <span class="notification-date float-right w-100"><time class="entry-date updated">{{message.full_date}}</time></span>
                                                        </div>
                                                    </li>

                                                    <li v-else-if="selectedChatArray.audience_id === message.receiver_id">
                                                        <div class="author-thumb float-left">
                                                            <img class="img-circle-30" :src="user.path_sm" :alt="user.family" :title="user.family">
                                                        </div>
                                                        <div class="notification-event pr-2 pl-0 w-100">
                                                            <div class="w-100 float-left">
                                                                <div v-html="message.description" class="chat-message-item float-left"></div>
                                                            </div>
                                                            <span class="notification-date float-left w-100 text-left"><time class="entry-date updated">{{message.full_date}}</time></span>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: -30px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 30px; height: 350px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 22px; height: 255px;"></div></div></div>

                                            <form>

                                                <div  class="form-group label-floating is-empty" v-if="selectedChatArray.audience_id">
                                                    <label class="control-label" style="right: 65px!important;">متن پیام ...</label>
                                                    <textarea class="form-control" placeholder="" v-model="v_message"></textarea>

                                                    <div class="add-options-message">
                                                        <span class="options-message btn-send-chat-box" @click="sendMessage(selectedChatArray.audience_id)">
                                                            <i class="fas fa-paper-plane"></i>
                                                        </span>
                                                    </div>

                                                    <span class="material-input"></span></div>

                                            </form>


                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                    <div v-show="flag_tabs['friend_requests']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">درخواست های دوستی</h6>
                        </div>
                        <div class="ui-block-content">


                            <div class="more-with-triangle triangle-top-center" dir="rtl">

                                <div class="">
                                    <ul class="notification-list" v-if="friendRequests.length > 0">

                                        <li v-for="requests in friendRequests" class="with-comment-photo">
                                            <div class="author-thumb">
                                                <img class="img-circle-40" :src="requests.sender.path_sm" :alt="requests.sender.family" :title="requests.sender.family">
                                            </div>
                                            <div class="notification-event">
                                                <div><a :href="'/profile/'+requests.sender.url" class="notification-friend fs0-75">{{requests.sender.family}}</a> برای شما درخواست دوستی ارسال کرد.</div>
                                                <span class="notification-date ml-1"><time class="entry-date updated">{{requests.full_date}}</time></span>
                                            </div>

                                            <div class="btn-friendship">
                                                <span class="btn btn-sm btn-green" @click="acceptFriendShip(requests.id , requests.sender.family)">پذیرفتن</span>
                                                <span class="btn btn-sm btn-danger" @click="refuseFriendShip(requests.id , requests.sender.family)">رد کردن</span>
                                            </div>

                                            <span v-if="!requests.has_seen" class="unseen-notify text-danger unseen-friend-request" v-bind:class="{'alert-light-border unread-notification' : !requests.has_seen}">
                                                جدید
                                            </span>



                                        </li>

                                    </ul>

                                    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                            </div>


                        </div>

                    </div>


                    <div v-show="flag_tabs['bookmarks']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">صفحات نشان شده</h6>
                        </div>
                        <div class="ui-block-content">


                            <div class="more-with-triangle triangle-top-center" dir="rtl">

                                <div class="">
                                    <ul class="notification-list" v-if="userBookmarks.length > 0">

                                        <li v-for="(bookmark , index) in userBookmarks" class="with-comment-photo">
                                            <div class="author-thumb">
                                                <img class="bookmark-post-img" :src="bookmark.bookmarkable.path_sm" :alt="bookmark.bookmarkable.title" :title="bookmark.bookmarkable.title">
                                            </div>
                                            <div class="notification-event">
                                                <div><a :href="bookmark.bookmarkable.category.sort+'/posts/'+bookmark.bookmarkable.category.slug+'/'+bookmark.bookmarkable.slug" class="notification-friend fs0-75 mr-4">{{bookmark.bookmarkable.title}}</a></div>
                                            </div>

                                            <div class="btn-friendship">
                                                <span class="btn btn-sm btn-danger" @click="deleteBookmark(bookmark.id , index)">حذف</span>
                                            </div>

                                        </li>

                                    </ul>

                                    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; height: 300px; right: 0px; opacity: 0;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 148px;"></div></div></div>

                            </div>


                        </div>

                    </div>





                </div>

                <div class="col col-xl-3 order-xl-1 col-lg-3 order-lg-1 col-md-12 order-md-2 col-sm-12  responsive-display-none">
                    <div class="ui-block">



                        <!-- Your Profile  -->

                        <div class="your-profile">

                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a>
                                                حساب کاربری
                                                <svg class="olymp-dropdown-arrow-icon"><use xlink:href=/frontend/svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                            </a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                        <ul class="your-profile-menu panel-menu-items">
                                            <!--<li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'dashboard'}}">
                                                    <span v-bind:class="{'active': flag_tabs['dashboard']}">میز کار</span>
                                                </router-link>
                                            </li>-->
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'personal'}}">
                                                <span v-bind:class="{'active': flag_tabs['personal']}">اطلاعات شخصی</span>
                                                </router-link>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'educational'}}">
                                                <span v-bind:class="{'active': flag_tabs['educational']}">اطلاعات دانشجویی</span>
                                                </router-link>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'hobbies'}}">
                                                <span v-bind:class="{'active': flag_tabs['hobbies']}">علایق و مهارت ها</span>
                                                </router-link>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'social-networks'}}">
                                                <span v-bind:class="{'active': flag_tabs['social_networks']}">شبکه های اجتماعی</span>
                                                </router-link>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'change-password'}}">
                                                <span v-bind:class="{'active': flag_tabs['change_password']}" class="change-password py-0">تغییر رمز عبور</span>
                                                </router-link>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <router-link :to="{name:'panel' , params:{section:'settings'}}">
                                                <span v-bind:class="{'active': flag_tabs['settings']}" >تنظیمات حساب کاربری</span>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                                <router-link :to="{name:'panel' , params:{section:'posts'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['posts']}" class="title cursor-pointer text-dark">پست ها</span>
                                    <span class="items-round-little bg-dark">{{user.posts_count}}</span>
                                </router-link>

                                <router-link :to="{name:'panel' , params:{section:'friends'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['friends']}" class="title cursor-pointer text-dark">دوستان</span>
                                    <span class="items-round-little bg-dark">{{friends_number}}</span>
                                </router-link>

                                <router-link :to="{name:'panel' , params:{section:'notifications'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['notifications']}" class="title cursor-pointer text-dark">اعلان ها</span>
                                    <span class="items-round-little bg-primary">{{unreadNotifications}}</span>
                                </router-link>

                                <router-link :to="{name:'panel' , params:{section:'messages'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['messages']}" class="title cursor-pointer text-dark">پیام ها</span>
                                    <span class="items-round-little bg-primary">{{allUnreadMessages}}</span>
                                </router-link>

                                <router-link :to="{name:'panel' , params:{section:'friend-requests'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['friend_requests']}" class="title cursor-pointer text-dark">درخواست های دوستی</span>
                                    <span class="items-round-little bg-blue">{{friendRequests.length}}</span>
                                </router-link>

                                <router-link :to="{name:'panel' , params:{section:'bookmarks'}}" class="ui-block-title">
                                    <span v-bind:class="{'text-primary': flag_tabs['bookmarks']}" class="title cursor-pointer text-dark">صفحات مورد علاقه</span>
                                    <span class="items-round-little bg-blue">{{userBookmarks.length}}</span>
                                </router-link>
                        </div>

                        <!-- ... end Your Profile  -->


                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>


    /*loader*/
    import {AtomSpinner} from 'epic-spinners'

    /**select by search**/
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)

    import 'vue-select/dist/vue-select.css';

    /**vue validation**/
    const customMessages = {
        custom: {

            'name': {
                required: ' (وارد کردن نام الزامی است) ',
            },

            'last_name': {
                required: ' (وارد کردن نام خانوادگی الزامی است) ',
            },

            'password': {
                required: ' (رمز عبور نمی تواند خالی باشد) ',
                min: ' (رمز عبور باید حداقل 6 کاراکتر باشد) '
            },

            'password_confirmation': {
                confirmed: ' (رمز عبور با تکرار آن مطابقت ندارد) ',
                required: ' (تکرار رمز عبور نمی تواند خالی باشد) '
            },
        }
    };

    /**persian datepicker**/
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker'


    /*document.addEventListener("DOMContentLoaded", () => {*/
        export default {
            data() {
                return {
                    books: '',
                   /* flag_tabs: {
                        dashboard: false,
                        personal: false,
                        educational: false,
                        hobbies: false,
                        social_networks: false,
                        change_password: false,
                        settings: false,
                        posts: false,
                        notifications: false,
                        messages: false,
                        friend_requests: false,
                        bookmarks: false,
                    },*/

                    flag_tabs : [
                        { dashboard: false },
                        { personal: false },
                        { educational: false },
                        { hobbies: false },
                        { social_networks: false },
                        { change_password: false },
                        { settings: false },
                        { posts: false },
                        { notifications: false },
                        { messages: false },
                        { friend_requests: false },
                        { bookmarks: false },
                    ],

                    flag_loader: false,

                    /*from register component*/

                    yearsLoop: [],
                    majors: [],
                    birthday: this.user.birthday,
                    provinces: [],
                    v_province: '',
                    cities: [],
                    v_city: '',
                    subCities: [],
                    v_subCity: '',
                    v_college: '',
                    v_major: '',
                    targetMajors: [],
                    v_yearNow: '',
                    flag_userStatus: '',
                    v_college_end1: '',
                    v_yearEnd1: '',
                    v_majorEnd1: '',
                    flag_addMajor1: false,
                    flag_addMajor2: false,
                    v_college_end2: '',
                    v_yearEnd2: '',
                    v_majorEnd2: '',
                    v_college_end3: '',
                    v_yearEnd3: '',
                    v_majorEnd3: '',
                    dorms: [],
                    dormStatus: 'dorm-vru',
                    v_dorm: '',
                    v_provinceBorn: '',
                    v_cityBorn: '',
                    v_subCityBorn: '',
                    citiesBorn: [],
                    subCitiesBorn: [],
                    flag_gender: true,
                    v_gender: '',
                    genderArray: ['مرد', 'زن'],
                    v_fromForeign: false,
                    v_school1: '',
                    v_school2: '',
                    v_school3: '',
                    flag_titleShow: '',
                    v_liveForeign: false,
                    reg_name: this.user.name,
                    reg_lastName: this.user.last_name,
                    reg_alias: this.user.alias_original,
                    reg_phone: this.user.phone,

                    createForm: {
                        email: ''
                    },
                    /*croppa*/
                    croppa: {},
                    sliderVal: 0,
                    sliderMin: 0,
                    sliderMax: 0,
                    /*end croppa*/
                    emailUniqueError: false,
                    aliasUniqueError: false,
                    majorNowRequiredError: false,
                    yearNowRequiredError: false,
                    majorEnd1RequiredError: false,
                    yearEnd1RequiredError: false,
                    schools: [],
                    accounts: [],
                    fileName: '',
                    flag_justRequiredFields: false,
                    flag_isRequired: false,
                    changeImage: false,

                    /*end register component*/
                    oldProvince: null,
                    oldCity: null,
                    oldSubCity: null,
                    oldCountry: null,
                    flag_changeCity: false,
                    flag_changeBirthCity: false,
                    flag_changeAvatar: false,
                    postItems: 15,
                    flag_hasMore: false,
                    flag_changeProfileImage: '',
                    flag_changeHeaderImage: '',
                    userHeaderPath: '/frontend/img/top-header1.jpg',
                    flag_profileChanged: false,
                    userProfilePath: '',
                    flag_hasProfileImage: '',
                    oldLivePlaceId: '',
                    oldBirthPlaceId: '',
                    oldSchoolId1: '',
                    oldSchoolId2: '',
                    oldSchoolId3: '',
                    flag_liveChanged: '',
                    flag_birthChanged: '',
                    v_editEducationRequest: '',
                    reg_password: '',
                    reg_cPassword: '',
                    notifications2: [],
                    notificationItems: 10,
                    flag_showMoreNotifications: true,
                    unreadNotifications: 0,
                    messagesPage: 1,
                    unreadMessages: '',
                    audienceMessages: [],
                    selectedChatArray: [],
                    flag_headerUploading: false,
                    profileInterval: '',
                    headerInterval: '',
                    v_message: '',
                    friendRequests: [],
                    allUnreadMessages: '',
                    userBookmarks: [],
                    account_twitter: '',
                    account_facebook: '',
                    account_email: '',
                    account_linkedin: '',
                    account_telegram: '',
                    account_instagram: '',
                    flag_ProfileUploading: false,
                    selected: '',
                    oldBirthCountry: '',
                    oldBirthProvince: '',
                    oldBirthCity: '',
                    oldBirthSubCity: '',
                    v_selfDescription : '',
                    oldLiveCountry: '',
                    oldLiveProvince: '',
                    oldLiveCity: '',
                    oldLiveSubCity: '',
                    v_selfDescription : '',
                    v_favorites_book: '',
                    v_favorites: '',
                    cv: '',
                    v_favorites_music: '',
                    v_favorites_movie: '',
                    v_skills: '',
                    flag_hasHeaderImage: '',




                }
            },
            components: {
                AtomSpinner,
                datePicker: VuePersianDatetimePicker,
            },
            props: [
                'avatars', 'user', 'friends_number'
            ],
            updated() {

            },

            beforeMount(){


            },

            mounted() {
                this.initFriendRequests();

                if (this.$route.params.section) {
                    var tab = this.$route.params.section;

                    if (tab === 'social-networks') {
                        tab = 'social_networks';
                    }
                    if (tab === 'friend-requests') {
                        tab = 'friend_requests';
                    }
                    if (tab === 'change-password') {
                        tab = 'change_password';
                    }

                    this.$Progress.start();
                    setTimeout(() => {
                        this.$Progress.finish()
                    }, 1500);
                    Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                    this.flag_tabs[tab] = true;
                    sessionStorage.setItem('tab_panel', tab);
                }

                this.initNotifications();
                this.initMessages();

                this.getInitializeData();
                this.initializeForMounted();

                setTimeout(() => {
                    this.checkHasMoreNotifications();

                }, 2000);

            },

            watch: {

                reg_alias: function (val) {
                    if (val === sessionStorage.getItem('uniqueAlias')) {
                        this.aliasUniqueError = true;
                    } else {
                        this.aliasUniqueError = false;
                    }
                },


                flag_userStatus: function (val) {
                    if (val !== 'now' && this.flag_justRequiredFields === true) {
                        this.flag_isRequired = true;
                    } else {
                        this.flag_isRequired = false;
                    }
                },

                '$route'(to, from) {
                    var tab = to.params.section;

                    if (tab === 'social-networks') {
                        tab = 'social_networks';
                    }
                    if (tab === 'friend-requests') {
                        tab = 'friend_requests';
                    }
                    if (tab === 'change-password') {
                        tab = 'change_password';
                    }

                    this.$Progress.start();
                    setTimeout(() => {
                        this.$Progress.finish()
                    }, 1500);
                    Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                    this.flag_tabs[tab] = true;
                    sessionStorage.setItem('tab_panel', tab);

                    if (tab === 'notifications') {
                        this.readNotifications('notifications');
                    }

                    if (tab === 'friend_requests'){
                        this.readNotifications('friendRequests');
                    }

                }

            },
            methods: {

                initializeForMounted: function () {

                    if (this.user.header.length > 0) {
                        this.userHeaderPath = '/images/lg/' + this.user.header[0].path;
                        this.flag_hasHeaderImage = true;
                    }

                    if (this.user.photo !== null) {
                        this.flag_hasProfileImage = true;
                    }

                    if (this.postItems >= this.user.posts.length) {
                        this.flag_hasMore = false;
                    } else {
                        this.flag_hasMore = true;
                    }


                    if (this.user.gender === 1) {
                        this.v_gender = 'مرد'
                    } else if (this.user.gender === 0) {
                        this.v_gender = 'زن'
                    }

                    for (var i = 0; i < this.user.places.length; i++) {
                        if (this.user.places[i].type === 'live') {
                            if (this.user.places[i].country) {
                                this.oldCountry = this.user.places[i].country;
                            } else {
                                this.oldProvince = this.user.places[i].province.title;
                                this.oldCity = this.user.places[i].city.title;
                                this.oldSubCity = this.user.places[i].subcity.title;
                            }
                            this.oldLivePlaceId = this.user.places[i].id;
                        } else if (this.user.places[i].type === 'birth') {
                            if (this.user.places[i].country) {
                                this.oldCountry = this.user.places[i].country;
                            } else {
                                this.oldBirthProvince = this.user.places[i].province.title;
                                this.oldBirthCity = this.user.places[i].city.title;
                                this.oldBirthSubCity = this.user.places[i].subcity.title;
                            }
                            this.oldBirthPlaceId = this.user.places[i].id;
                        }

                    }

                    if (this.user.status === 'now') {
                        this.flag_userStatus = 'now';
                    }

                    this.dormStatus = this.user.location;

                    for (var i = 0; i < this.user.categories.length; i++) {
                        if (this.user.categories[i].sort === 'dorm') {
                            this.v_dorm = this.user.categories[i].titles;
                        }
                    }

                    this.v_selfDescription = this.user.description;
                    this.v_favorites_book = this.user.favorites_book;
                    this.v_favorites = this.user.favorites;
                    this.cv = this.user.cv;
                    this.v_favorites_music = this.user.favorites_music;
                    this.v_favorites_movie = this.user.favorites_movie;
                    this.v_skills = this.user.skills;

                    for (var i = 0; i < this.user.accounts.length; i++) {
                        if (this.user.accounts[i].type === 'telegram') {
                            this.account_telegram = this.user.accounts[i].address;
                        }
                        if (this.user.accounts[i].type === 'instagram') {
                            this.account_instagram = this.user.accounts[i].address;
                        }
                        if (this.user.accounts[i].type === 'linkedin') {
                            this.account_linkedin = this.user.accounts[i].address;
                        }
                        if (this.user.accounts[i].type === 'accountEmail') {
                            this.account_email = this.user.accounts[i].address;
                        }
                        if (this.user.accounts[i].type === 'facebook') {
                            this.account_facebook = this.user.accounts[i].address;
                        }
                        if (this.user.accounts[i].type === 'twitter') {
                            this.account_twitter = this.user.accounts[i].address;
                        }
                    }

                    for (var i = 0; i < this.user.schools.length; i++) {
                        if (this.user.schools[i].type === 1) {
                            this.v_school1 = this.user.schools[i].title;
                            this.oldSchoolId1 = this.user.schools[i].id;
                        }
                        if (this.user.schools[i].type === 2) {
                            this.v_school2 = this.user.schools[i].title;
                            this.oldSchoolId2 = this.user.schools[i].id;
                        }
                        if (this.user.schools[i].type === 3) {
                            this.v_school3 = this.user.schools[i].title;
                            this.oldSchoolId3 = this.user.schools[i].id;
                        }
                    }

                    this.userBookmarks = this.user.bookmarks;

                    /**vue validate**/
                    this.$validator.localize('en', customMessages);


                    /*this.croppa.addClipPlugin(function (ctx, x, y, w, h) {
                        ctx.beginPath();
                        ctx.arc(x + w / 2, y + h / 2, w / 2, 0, 2 * Math.PI, true);
                        ctx.closePath()
                    });*/

                },

                /*from register component*/

                getInitializeData: function () {
                    axios.get('/api/panel/initial').then(res => {
                        this.createYearsLoop(res.data.year);
                        this.majors = res.data.majors;
                        this.provinces = res.data.provinces;
                        this.dorms = res.data.dorms;
                    }).catch(err => {
                        console.log(err);
                    })
                },

                createYearsLoop: function (year) {
                    for (var i = year; i >= 1370; i--) {
                        this.yearsLoop.push(i);
                    }
                },

                selectFocus: function (number) {
                    this.flag_titleShow = number;
                },

                selectUnFocus: function () {
                    this.flag_titleShow = '';
                },

                showCities: function (type = null) {
                    var provinceId = '';
                    if (type === 'born') {
                        provinceId = this.v_provinceBorn.value
                        this.v_cityBorn = ''
                        this.v_subCityBorn = ''
                    } else {
                        provinceId = this.v_province.value
                        this.v_city = ''
                        this.v_subCity = ''
                    }
                    axios.get('/api/panel/getCities/' + provinceId).then(res => {
                        if (type === 'born') {
                            this.citiesBorn = res.data.cities;
                        } else {
                            this.cities = res.data.cities;
                        }
                    }).catch(err => {
                        console.log(err);
                    })
                },

                showSubCities: function (type = null) {
                    var cityId = '';
                    if (type === 'born') {
                        this.v_subCityBorn = ''
                        cityId = this.v_cityBorn.value
                    } else {
                        this.v_subCity = ''
                        cityId = this.v_city.value
                    }

                    axios.get('/api/panel/getSubCities/' + cityId).then(res => {
                        if (type === 'born') {
                            this.subCitiesBorn = res.data.subCities;
                        } else {
                            this.subCities = res.data.subCities;
                        }
                    }).catch(err => {
                        console.log(err);
                    })
                },

                showMajors: function (type = null) {
                    if (type === 'now') {
                        this.v_major = '';
                    } else if (type === 'end1') {
                        this.v_majorEnd1 = '';
                    } else if (type === 'end2') {
                        this.v_majorEnd2 = '';
                    } else if (type === 'end3') {
                        this.v_majorEnd3 = '';
                    }

                },

                addMajor: function (number) {
                    if (number === 1) {
                        this.flag_addMajor1 = true;
                    } else if (number === 2) {
                        this.flag_addMajor2 = true;
                    }
                },

                /**vue validate**/
                validateBeforeSubmit() {
                    this.$validator.validateAll();
                },

                /**image croppa**/
                upload(type) {
                    var url = '';
                    if (type === 'header') {
                        url = '/api/upload/header';
                    } else if (type === 'profile') {
                        url = '/api/upload';
                    }

                    if (!this.croppa.hasImage()) {
                        alert('تصویری برای بارگذاری وجود ندارد');
                        return
                    }

                    this.croppa.generateBlob((blob) => {
                        var fd = new FormData();

                        fd.append('file', blob, this.fileName);
                        fd.append('registering', 'no');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            data: fd,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if (type === 'header') {
                                    sessionStorage.setItem('header-image', data.path);
                                } else if (type === 'profile') {
                                    sessionStorage.setItem('profile-image', data.path);
                                }

                            }
                        })
                    })

                },


                handleFileChoose(file) {
                    this.fileName = file.name;
                },

                showRequired: function () {
                    this.flag_justRequiredFields = !this.flag_justRequiredFields
                },

                onNewImage() {
                    this.sliderVal = this.croppa.scaleRatio
                    this.sliderMin = this.croppa.scaleRatio / 2
                    this.sliderMax = this.croppa.scaleRatio * 2
                },

                onSliderChange(evt) {
                    var increment = evt.target.value
                    this.croppa.scaleRatio = +increment
                },

                onZoom() {
                    // To prevent zooming out of range when using scrolling to zoom
                    // if (this.sliderMax && this.croppa.scaleRatio >= this.sliderMax) {
                    //   this.croppa.scaleRatio = this.sliderMax
                    // } else if (this.sliderMin && this.croppa.scaleRatio <= this.sliderMin) {
                    //   this.croppa.scaleRatio = this.sliderMin
                    // }

                    this.sliderVal = this.croppa.scaleRatio
                },

                /*end register component*/

                changeCity: function () {
                    this.flag_changeCity = true;
                },

                changeAvatar: function () {
                    this.flag_changeAvatar = true;
                },

                changeBirthCity: function () {
                    this.flag_changeBirthCity = true;
                },

                showMorePosts: function () {

                    this.flag_loader = true;
                    setTimeout(() => {
                        this.flag_loader = false;
                        this.postItems = this.postItems + 15;
                        if (this.postItems >= this.user.posts.length) {
                            this.flag_hasMore = false;
                        }
                    }, 2500);
                },

                changeHeaderImage: function () {
                    this.flag_changeProfileImage = false;
                    this.flag_changeHeaderImage = true;
                    this.croppa.refresh();
                },

                changeProfileImage: function () {
                    this.flag_changeHeaderImage = false;
                    this.flag_changeProfileImage = true;
                    this.croppa.refresh();
                },

                setHeaderImage: function () {
                    this.flag_headerUploading = true;
                    this.upload('header');
                            this.headerInterval = setInterval(() => {
                        if (sessionStorage.getItem('header-image')) {
                            this.userHeaderPath = '/images/lg/' + sessionStorage.getItem('header-image');
                            this.$notify({
                                group: 'alert-panel',
                                type: 'success',
                                duration: 15000,
                                text: 'تصویر زمینه ثبت شد'
                            });
                            sessionStorage.removeItem('header-image');
                            this.flag_headerUploading = false;
                            this.flag_hasHeaderImage = true;
                            clearInterval(this.headerInterval);
                        }

                    }, 100)
                },

                deleteHeaderImage: function () {
                    axios.post('/api/userHeader/delete').then(res => {
                        this.userHeaderPath = '/frontend/img/top-header1.jpg';
                        this.flag_hasHeaderImage = false;
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تصویر زمینه شما حذف شد'
                        });
                    }).catch(err => {
                    })
                },

                setProfileImage: function () {
                    this.flag_ProfileUploading = true;
                    this.upload('profile');
                        this.profileInterval = setInterval(() => {
                            if (sessionStorage.getItem('profile-image')) {
                                this.flag_profileChanged = true;
                                this.flag_hasProfileImage = true;
                                this.userProfilePath = '/images/md/' + sessionStorage.getItem('profile-image');
                                this.$notify({
                                    group: 'alert-panel',
                                    type: 'success',
                                    duration: 15000,
                                    text: 'تصویر پروفایل شما ثبت شد'
                                });
                                sessionStorage.removeItem('profile-image');
                                this.flag_ProfileUploading = false;
                                clearInterval(this.profileInterval);
                            }
                        } , 1000);


                },

                deleteProfileImage: function () {
                    axios.post('/api/userProfile/delete').then(res => {
                        this.userProfilePath = this.avatars['user_avatar_unknown'];
                        this.flag_hasProfileImage = false;
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تصویر زمینه شما حذف شد'
                        });
                    }).catch(err => {
                    })
                },

                submitPersonalInformation: function () {
                    if (this.reg_name === '') {
                        this.reg_name = ''
                    }
                    if (this.reg_lastName === '') {
                        this.reg_lastName = ''
                    }

                    var gender = '';
                    if (this.v_gender === 'مرد') {
                        gender = 1;
                    } else if (this.v_gender === 'زن') {
                        gender = 0;
                    }

                    if (this.v_liveForeign) {
                        this.v_province = '';
                        this.v_city = '';
                        this.v_subCity = '';
                    }

                    if (this.dormStatus !== 'dorm-vru') {
                        this.v_dorm = '';
                    }

                    if (this.v_fromForeign) {
                        this.v_provinceBorn = ''
                        this.v_cityBorn = ''
                        this.v_subCityBorn = ''
                    }


                    axios.post('/panel/edit/personal', {
                        'name': this.reg_name,
                        'last_name': this.reg_lastName,
                        'alias': this.reg_alias,
                        'phone': this.reg_phone,
                        'liveForeign': this.reg_liveForeign,
                        'isLiveForeign': this.v_liveForeign,
                        'birthday': this.birthday,
                        'gender': gender,
                        'provinceLive': this.v_province.value,
                        'cityLive': this.v_city.value,
                        'subCityLive': this.v_subCity.value,
                        'birthPlaceProvince': this.v_provinceBorn.value,
                        'birthPlaceCity': this.v_cityBorn.value,
                        'birthPlaceSubCity': this.v_subCityBorn.value,
                        'isBornedForeign': this.v_fromForeign,
                        'foreignBirthPlace': this.v_foreignBirthPlace,
                        'school1': this.v_school1,
                        'school2': this.v_school2,
                        'school3': this.v_school3,
                        'birthId': this.oldBirthPlaceId,
                        'liveId': this.oldLivePlaceId,
                        'schoolId1': this.oldSchoolId1,
                        'schoolId2': this.oldSchoolId2,
                        'schoolId3': this.oldSchoolId3,

                    }).then(res => {
                        if (res.data.result === 'updated') {
                            this.$notify({
                                group: 'alert-panel',
                                type: 'success',
                                duration: 20000,
                                text: 'اطلاعات پروفایل شما به روزرسانی شد'
                            });

                            var changes = res.data.changes;
                            for (var i = 0; i < changes.length; i++) {
                                if (changes[i] === 'live') {
                                    this.flag_liveChanged = true;
                                }
                                if (changes[i] === 'birth') {
                                    this.flag_birthChanged = true;
                                }
                            }

                        }
                    }).catch(err => {

                        if (this.reg_name === '') {
                            this.reg_name = ''
                            this.$notify({
                                group: 'alert-panel',
                                type: 'error',
                                duration: 20000,
                                text: 'نام خود را وارد کنید'
                            })
                        }
                        if (this.reg_lastName === '') {
                            this.reg_lastName = ''
                            this.$notify({
                                group: 'alert-panel',
                                type: 'error',
                                duration: 20000,
                                text: 'نام خانوادگی خود را وارد کنید'
                            })
                        }


                        if (err.response.data.errors.alias) {

                            this.$notify({
                                group: 'reg',
                                type: 'error',
                                duration: 20000,
                                text: 'نام مستعاری که وارد کرده اید قبلا توسط کاربر دیگری در سایت استفاده شده است'
                            })

                            this.aliasUniqueError = true;
                            sessionStorage.removeItem('uniqueAlias');
                            sessionStorage.setItem('uniqueAlias', this.reg_alias)
                        }

                    })


                },

                submitEducationInformation: function () {
                    axios.post('/panel/edit/education', {
                        'description': this.v_editEducationRequest,
                        'dormStatus': this.dormStatus,
                        'dorm': this.v_dorm.id
                    }).then(res => {
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تغییرات مورد نظر اعمال شد'
                        });
                    }).catch(err => {
                    })
                },

                cancelEducationInformation: function () {

                },

                submitHobbiesInformation: function () {

                    var description = $('.self-description').html();
                    var books = $('.favorite-books').html();
                    var favorites = $('.favorites').html();
                    var cv = $('.user-cv').html();
                    var musics = $('.favorite-musics').html();
                    var movies = $('.favorite-movies').html();
                    var skills = $('.favorite-skills').html();

                    axios.post('/panel/edit/hobbies', {
                        'selfDescription': description,
                        'favorites': favorites,
                        'cv': cv,
                        'skills': skills,
                        'favorites_book': books,
                        'favorites_music': musics,
                        'favorites_movie': movies
                    }).then(res => {
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تغییرات مورد نظر اعمال شد'
                        });
                    }).catch(err => {
                    })
                },

                cancelHobbiesInformation: function () {

                },

                submitAccountsEdit: function () {

                    this.accounts = {
                        'telegram': this.account_telegram,
                        'instagram': this.account_instagram,
                        'linkedin': this.account_linkedin,
                        'accountEmail': this.account_email,
                        'facebook': this.account_facebook,
                        'twitter': this.account_twitter,
                    }

                    axios.post('/panel/edit/accounts', {
                        'accounts': this.accounts,
                    }).then(res => {
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تغییرات مورد نظر اعمال شد'
                        });
                    }).catch(err => {
                    })
                },

                cancelAccountsEdit: function () {

                },

                submitPasswordEdit: function () {

                    axios.post('/panel/edit/password', {
                        'password': this.reg_password,
                        'password_confirmation': this.reg_cPassword,
                    }).then(res => {
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'رمز عبور شما با موفقیت تغییر یافت'
                        });
                    }).catch(err => {
                    })
                },

                cancelPasswordEdit: function () {

                },

                initNotifications: function () {
                    axios.post('/api/panel/notifications/alerts').then(res => {
                        this.notifications2 = res.data;
                        this.unreadNotifications = 0;
                        for (var i = 0; i < res.data.length; i++) {
                            if (!res.data[i]['has_seen']){
                                this.unreadNotifications++;
                            }
                        }
                    }).catch(err => {
                    })
                },

                moreNotifications: function () {
                    this.notificationItems += 10;
                    this.checkHasMoreNotifications();
                },

                checkHasMoreNotifications: function () {
                    this.flag_showMoreNotifications = (this.notifications2.length > this.notificationItems);
                },

                readNotifications: function (notifications, items = null) {
                    axios.post('/api/notifications/read', {
                        'notifications': notifications,
                        'items': items
                    }).then(res => {
                    }).catch(err => {
                        console.log(err);
                    })
                },

                initMessages: function () {
                    axios.get('/api/panel/notifications/messages').then(res => {
                        this.audienceMessages = res.data.audience;

                        this.allUnreadMessages = 0;
                        for (var i = 0; i < res.data.audience.length; i++) {
                                    this.allUnreadMessages+= res.data.audience[i]['unseen_items']

                        }
                    }).catch(err => {
                    })
                },

                selectChat: function (audienceId) {
                    axios.post('/api/panel/message', {'audienceId': audienceId}).then(res => {
                        this.selectedChatArray = res.data;
                        this.seenAudienceMessages(audienceId);
                            setTimeout(() => {
                                this.scrollToEnd();
                            },1100);
                    }).catch(err => {
                    })
                },

                deleteCity: function (type) {
                    axios.post('/panel/delete/city', {
                        'type': type,
                    }).then(res => {
                        if (type === 'live') {
                            this.flag_liveChanged = true;
                        } else if (type === 'birth') {
                            this.flag_birthChanged = true;
                        }
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 15000,
                            text: 'تغییرات مورد نظر اعمال شد'
                        });
                    }).catch(err => {
                    })
                },

                seenAudienceMessages: function (audienceId) {
                    axios.post('/panel/messages/seen', {
                        'audienceId': audienceId,
                    }).then(res => {
                        for (var i=0; i<this.audienceMessages.length; i++){
                            if (this.audienceMessages[i].audience_id === audienceId){
                                this.audienceMessages[i]['unseen_items'] = 0;
                            }
                        }
                    }).catch(err => {
                    })
                },

                scrollToEnd(){
                    var container = document.querySelector(".messages-scroll");
                    var scrollHeight = container.scrollHeight;
                    container.scrollTop = scrollHeight;
                },

                sendMessage:function (audienceId) {
                    axios.post('/panel/messages/send', {
                        'audienceId': audienceId,
                        'description': this.v_message
                    }).then(res => {
                        this.v_message ='';
                        this.selectChat(audienceId);
                        this.scrollToEnd();
                    }).catch(err => {
                    })
                },

                initFriendRequests:function () {
                    axios.get('/panel/friends/requests').then(res => {
                        this.friendRequests = res.data.friendRequests;
                    }).catch(err => {
                    })
                },

                acceptFriendShip: function (requestId , friendFamily) {
                    axios.post('/api/profile/acceptFriendShip', {'requestId': requestId}).then(res => {
                        this.initFriendRequests();
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 20000,
                            text: friendFamily+' به لیست دوستان شما اضافه شد'
                        });
                    }).catch(err => {
                        console.log(err);
                    })
                },

                refuseFriendShip: function (requestId , friendFamily) {
                    axios.post('/api/friends/cancelFriendShip', {'friendShipId': requestId}).then(res => {
                        this.initFriendRequests();
                        this.$notify({
                            group: 'alert-panel',
                            type: 'error',
                            duration: 20000,
                            text: 'درخواست دوستی' + ' ' +friendFamily+ ' ' + 'رد شد'
                        });
                    }).catch(err => {
                        console.log(err);
                    })
                },

                deleteBookmark:function (bookmarkId , index) {
                    axios.post('/panel/bookmarks/delete', {'bookmarkId': bookmarkId}).then(res => {
                        this.userBookmarks.splice(index , 1);
                        this.$notify({
                            group: 'alert-panel',
                            type: 'success',
                            duration: 20000,
                            text: 'صفحه مورد نظر از لیست علاقه مندی های شما حذف شد'
                        });
                    }).catch(err => {
                        console.log(err);
                    })
                }


            }
        }

    /*});*/
</script>
