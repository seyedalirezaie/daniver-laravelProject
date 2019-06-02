<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">

    <div>

        <div class="main-header dashboard-header" dir="rtl">
            <div class="content-bg-wrap bg-account"></div>
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 m-auto col-md-8 col-sm-12 col-12">
                        <div class="main-header-content">
                            <h1>Your Account Dashboard</h1>
                            <p>Welcome to your account dashboard! Here you’ll find everything you need to change your profile
                                information, settings, read notifications and requests, view your latest messages, change your pasword and much
                                more! Also you can create or manage your own favourite page, have fun!</p>
                        </div>
                    </div>
                </div>
            </div>
            <img class="img-bottom" src="/frontend/img/account-bottom.png" alt="friends">
        </div>


        <div class="container-fluid px-0" dir="rtl">
            <div class="row">
                <div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
                    <div v-show="flag_tabs['personalInfo']" class="ui-block">
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
                                <span v-if="oldProvince !== null">{{oldProvince}}</span>
                                <span v-if="oldCity !== null">، {{oldCity}}</span>
                                <span v-if="oldSubCity !== null">، {{oldSubCity}}</span>
                                <span v-if="oldCountry !== null">{{oldCountry}}</span>
                                <span @click="changeCity()" class="btn btn-sm btn-gold mt-3 mr-2">ویرایش</span>
                                <span class="btn btn-sm btn-primary mt-3 mr-3">حذف</span>
                            </div>

                            <div v-show="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 1" class="control-label">استان محل زندگی</label>
                                    <v-select v-bind:disabled="v_liveForeign" @input="showCities()" v-model="v_province" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(1)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div v-show="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 2" class="control-label">شهرستان محل زندگی</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" @input="showSubCities()" v-model="v_city" dir="rtl" :searchable=true :value.sync="selected" :options=cities @search:blur="selectUnFocus()" @search:focus="selectFocus(2)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-show="flag_changeCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 3" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" v-model="v_subCity" dir="rtl" :searchable=true :value.sync="selected" :options=subCities @search:blur="selectUnFocus()" @search:focus="selectFocus(3)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-show="flag_changeCity" class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
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
                                <span v-if="oldBirthProvince !== null">{{oldBirthProvince}}</span>
                                <span v-if="oldBirthProvince !== null">، {{oldBirthProvince}}</span>
                                <span v-if="oldBirthSubCity !== null">، {{oldBirthSubCity}}</span>
                                <span v-if="oldBirthCountry !== null">{{oldBirthCountry}}</span>
                                <span @click="changeBirthCity()" class="btn btn-sm btn-gold mt-3 mr-2">ویرایش</span>
                                <span class="btn btn-sm btn-primary mt-3 mr-3">حذف</span>
                            </div>

                            <div v-show="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==17" class="control-label">استان</label>
                                    <v-select v-bind:disabled="v_fromForeign" @input="showCities('born')" v-model="v_provinceBorn" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(17)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div v-show="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==18" class="control-label">شهرستان</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" @input="showSubCities('born')" v-model="v_cityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=citiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(18)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-show="flag_changeBirthCity" class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 19" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" v-model="v_subCityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=subCitiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(19)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-show="flag_changeBirthCity" class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <input v-model="v_fromForeign" class="d-inline-block input-width-unset" type="checkbox">
                                <span class="mb-3">خارج از کشور</span>

                                <div v-if="v_fromForeign" class="form-group label-floating mt-3">
                                    <label class="control-label">نام کشور محل تولد خود را وارد کنید</label>
                                    <input v-model="v_foreignBirthPlace" class="form-control" placeholder="" type="text" value="James">
                                    <span class="material-input"></span></div>

                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                مدارس دوران تحصیل
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">ابتدایی</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school1">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">راهنمایی</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school2">
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">دبیرستان</label>
                                    <input class="form-control" placeholder="" type="text" v-model="v_school3">
                                    <span class="material-input"></span></div>
                            </div>


                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                تصویر پروفایل
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">

                                <img v-if="user.photo" :src="'/images/md/'+user.photo.path">
                                <span @click="changeAvatar()" v-if="user.photo" class="btn btn-sm btn-gold mr-3">ویرایش</span>
                                <span v-if="user.photo" class="btn btn-sm btn-primary mr-3">حذف</span>
                                <span  @click="changeAvatar()" v-else class="btn btn-sm btn-primary mr-3">افزودن</span>

                                <input v-show="flag_changeAvatar" type="range" @input="onSliderChange" :min="sliderMin" :max="sliderMax" step=".001" v-model="sliderVal">

                                <croppa v-show="flag_changeAvatar" @file-choose="handleFileChoose" @zoom="onZoom"  v-model="croppa" @new-image-drawn="onNewImage"
                                        :placeholder="'تصویر را انتخاب کنید'"
                                        :placeholder-font-size="14"
                                        :accept="'image/*'"
                                        :file-size-limit="0"
                                        :prevent-white-space="true"
                                        :width="180"
                                        :height="180"
                                        :quality="1.2">
                                    ></croppa>

                                <!--<span v-if="" class="btn btn-blue mb-4" @click="croppa.chooseFile()">تغییر تصویر...</span>-->

                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green">اعمال تغییرات</span>
                            <span class="btn btn-red mr-2">لغو تغییرات</span>
                        </div>

                    </div>

                    <div v-show="flag_tabs['educationInfo']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title">اطلاعات دانشجویی</h6>
                        </div>
                        <div class="ui-block-content">

                            <div v-if="flag_userStatus === 'now'" class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">

                                <h6 class="bg-grey-title p-3 rounded">وضعیت تحصیلی</h6>
                                <br/>
                                <br/>
                                <span class="fs0-75 mt-3 mb-3">توجه: به دلیل برخی مسائل تغییر لحظه ای رشته تحصیلی و دیگر اطلاعات مربوط به آن امکان پذیر نیست. در صورتی که می خواهید این اطلاعات را تغییر دهید با پر کردن دقیق فرم باز شده درخواست خود را برای تغییر اطلاعات ارسال فرمایید.</span>
                                <br/>
                                <br/>
                                <div class="form-group label-floating">
                                    <label class="control-label">مثال:دانشکده فنی و مهندسی، رشته مهندسی برق - کارشناسی - ورودی 1397 - در حال تحصیل</label>
                                    <textarea class="form-control"></textarea>
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
                            <span class="btn btn-green">اعمال تغییرات</span>
                            <span class="btn btn-red mr-2">لغو تغییرات</span>
                        </div>

                    </div>



                    <div v-show="flag_tabs['hobbiesInfo']" class="ui-block">
                        <div class="ui-block-title">
                            <h6 class="title bg-grey-title p-3 rounded">علایق و مهارت ها</h6>
                        </div>
                        <div class="ui-block-content">

                            <div class="col col-lg-9 col-md-9 col-sm-12 col-12">



                                <div>
                                    <label class="control-label">توضیح کوتاهی در مورد خودتان بنویسید</label>
                                    <div v-html="v_selfDescription" contenteditable="true" class="div-textarea rounded"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">کتاب های مورد علاقه؟</label>
                                    <div v-html="v_favorites_book" contenteditable="true" class="div-textarea rounded"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">سایر چیزها و کارهای مورد علاقه؟</label>
                                    <div v-html="v_favorites" contenteditable="true" class="div-textarea rounded"></div>
                                </div>

                                <div class="mt-5">
                                    <label class="control-label">رزومه، سوابق، شغل و ...</label>
                                    <div v-html="cv" contenteditable="true" class="div-textarea rounded"></div>
                                </div>


                            </div>
                            <div class="col col-lg-9 col-md-9 col-sm-12 col-12">

                                <div class="mt-5">
                                    <label class="control-label">موسیقی، آهنگ و خواننده مورد علاقه؟</label>
                                    <div v-html="v_favorites_music" contenteditable="true" class="div-textarea rounded"></div>
                                </div>


                                <div class="mt-5">
                                    <label class="control-label">فیلم سینمایی و سریال مورد علاقه؟</label>
                                    <div v-html="v_favorites_movie" contenteditable="true" class="div-textarea rounded"></div>
                                </div>


                                <div class="mt-5">
                                    <label class="control-label">مهارت های فنی، هنری، علمی و ...</label>
                                    <div v-html="v_skills" contenteditable="true" class="div-textarea rounded"></div>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 p-5 text-center">
                            <span class="btn btn-green">اعمال تغییرات</span>
                            <span class="btn btn-red mr-2">لغو تغییرات</span>
                        </div>

                    </div>


                    <div v-show="flag_tabs['socialNetworks']" class="ui-block">
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
                            <span class="btn btn-green">اعمال تغییرات</span>
                            <span class="btn btn-red mr-2">لغو تغییرات</span>
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

                                                            <ul class="friends-harmonic">
                                                                <li>
                                                                    <a href="#">
                                                                        <img src="/frontend/img/icon-chat27.png" alt="icon">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <img src="/frontend/img/icon-chat2.png" alt="icon">
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                26
                                                            </div>

                                                            <div class="comments-shared">
                                                                <a href="#" class="post-add-icon inline-items">
                                                                    <svg class="olymp-speech-balloon-icon"><use xlink:href="/frontend/svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                                                    <span>0</span>
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





                </div>

                <div class="col col-xl-3 order-xl-1 col-lg-3 order-lg-1 col-md-12 order-md-2 col-sm-12  responsive-display-none">
                    <div class="ui-block">



                        <!-- Your Profile  -->

                        <div class="your-profile">
                            <div class="ui-block-title ui-block-title-small">
                                <h6 class="title">Your PROFILE</h6>
                            </div>

                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Profile Settings
                                                <svg class="olymp-dropdown-arrow-icon"><use xlink:href=/frontend/svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use></svg>
                                            </a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                        <ul class="your-profile-menu">
                                            <li class="p-2 cursor-pointer">
                                                <span v-bind:class="{'active': flag_tabs['personalInfo']}" @click="changeTab('personalInfo')">اطلاعات شخصی</span>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <span v-bind:class="{'active': flag_tabs['educationInfo']}" @click="changeTab('educationInfo')">اطلاعات دانشجویی</span>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <span v-bind:class="{'active': flag_tabs['hobbiesInfo']}" @click="changeTab('hobbiesInfo')">علایق و مهارت ها</span>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <span v-bind:class="{'active': flag_tabs['socialNetworks']}" @click="changeTab('socialNetworks')">شبکه های اجتماعی</span>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <a class="change-password py-0">تغییر رمز عبور</a>
                                            </li>
                                            <li class="p-2 cursor-pointer">
                                                <span v-bind:class="{'active': flag_tabs['settings']}" @click="changeTab('settings')">تنظیمات حساب کاربری</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="ui-block-title">
                                <span v-bind:class="{'active': flag_tabs['posts']}" @click="changeTab('posts')" class="h6 title">پست ها</span>
                                <span class="items-round-little bg-primary">8</span>
                            </div>

                            <div class="ui-block-title">
                                <span v-bind:class="{'active': flag_tabs['friends']}" @click="changeTab('friends')" class="h6 title">دوستان</span>
                                <span class="items-round-little bg-primary">8</span>
                            </div>

                            <div class="ui-block-title">
                                <span v-bind:class="{'active': flag_tabs['notifications']}" @click="changeTab('notifications')" class="h6 title">اعلان ها</span>
                                <span class="items-round-little bg-primary">8</span>
                            </div>
                            <div class="ui-block-title">
                                <span v-bind:class="{'active': flag_tabs['messages']}" @click="changeTab('messages')" class="h6 title">پیام ها</span>
                                <span class="items-round-little bg-primary">8</span>
                            </div>
                            <div class="ui-block-title">
                                <span v-bind:class="{'active': flag_tabs['friendRequests']}" @click="changeTab('friendRequests')" class="h6 title">درخواست های دوستی</span>
                                <span class="items-round-little bg-blue">4</span>
                            </div>
                            <div class="ui-block-title ui-block-title-small">
                                <span v-bind:class="{'active': flag_tabs['favorites']}" @click="changeTab('favorites')" class="h6 title">صفحات مورد علاقه</span>
                                <span class="items-round-little bg-blue">4</span>
                            </div>
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
        }
    };

    /**persian datepicker**/
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker'



    export default {
        data(){
            return{
                flag_tabs:{
                    dashboard: true,
                    personalInfo: false,
                    educationInfo: false,
                    hobbiesInfo: false,
                    socialNetworks: false,
                    settings: false,
                    posts: false,
                    notifications: false,
                    messages: false,
                    friendRequests: false,
                    favorites: false,
                },
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
                v_college_end1 : '',
                v_yearEnd1: '',
                v_majorEnd1: '',
                flag_addMajor1: false,
                flag_addMajor2: false,
                v_college_end2 : '',
                v_yearEnd2: '',
                v_majorEnd2: '',
                v_college_end3 : '',
                v_yearEnd3: '',
                v_majorEnd3: '',
                dorms : [],
                dormStatus: 'dorm-vru',
                v_dorm: '',
                v_provinceBorn: '',
                v_cityBorn: '',
                v_subCityBorn: '',
                citiesBorn: [],
                subCitiesBorn: [],
                flag_gender: true,
                v_gender : '',
                genderArray: ['مرد' , 'زن'],
                v_fromForeign : false,
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
            }
        },
        components: {
            AtomSpinner,
            datePicker: VuePersianDatetimePicker,
        },
        props: [
            'user' , 'avatars'
        ],
        mounted() {
            if (sessionStorage.getItem('tab_panel')){
                this.changeTab(sessionStorage.getItem('tab_panel'));
            }

            if (this.postItems >= this.user.posts.length){
                this.flag_hasMore = false;
            } else {
                this.flag_hasMore = true;
            }

            this.getInitializeData();

            /**vue validate**/
            this.$validator.localize('en', customMessages);


            this.croppa.addClipPlugin(function (ctx, x, y, w, h) {
                ctx.beginPath();
                ctx.arc(x + w / 2, y + h / 2, w / 2, 0, 2 * Math.PI, true)
                ctx.closePath()
            });

            if(this.user.gender === 1){
                this.v_gender = 'مرد'
            } else if(this.user.gender === 0){
                this.v_gender = 'زن'
            }

            for (var i=0; i<this.user.places.length; i++){
                if (this.user.places[i].type === 'live'){
                    if (this.user.places[i].country){
                        this.oldCountry = this.user.places[i].country;
                    } else {
                        this.oldProvince = this.user.places[i].province.title;
                        this.oldCity = this.user.places[i].city.title;
                        this.oldSubCity = this.user.places[i].subcity.title;
                    }
                } else if (this.user.places[i].type === 'birth') {
                    if (this.user.places[i].country){
                        this.oldCountry = this.user.places[i].country;
                    } else {
                        this.oldBirthProvince = this.user.places[i].province.title;
                        this.oldBirthCity = this.user.places[i].city.title;
                        this.oldBirthSubCity = this.user.places[i].subcity.title;
                    }
                }
               
            }

            if(this.user.status === 'now'){
                this.flag_userStatus = 'now';
            }

            this.dormStatus = this.user.location;

            for (var i=0; i<this.user.categories.length; i++){
                if (this.user.categories[i].sort === 'dorm'){
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

            for (var i=0; i<this.user.accounts.length; i++){
                if (this.user.accounts[i].type === 'telegram'){
                    this.account_telegram = this.user.accounts[i].address;
                }
                if (this.user.accounts[i].type === 'instagram'){
                    this.account_instagram = this.user.accounts[i].address;
                }
                if (this.user.accounts[i].type === 'linkedin'){
                    this.account_linkedin = this.user.accounts[i].address;
                }
                if (this.user.accounts[i].type === 'accountEmail'){
                    this.account_email = this.user.accounts[i].address;
                }
                if (this.user.accounts[i].type === 'facebook'){
                    this.account_facebook = this.user.accounts[i].address;
                }
                if (this.user.accounts[i].type === 'twitter'){
                    this.account_twitter = this.user.accounts[i].address;
                }
            }



        },



        watch : {

            reg_alias:function(val) {
                if (val === sessionStorage.getItem('uniqueAlias')) {
                    this.aliasUniqueError = true;
                } else {
                    this.aliasUniqueError = false;
                }
            },


            flag_userStatus:function (val) {
                if (val !== 'now' && this.flag_justRequiredFields === true){
                    this.flag_isRequired = true;
                } else {
                    this.flag_isRequired = false;
                }
            },

        },
        methods: {

            changeTab:function(tab){
                this.$Progress.start();
                setTimeout(() => {
                    this.$Progress.finish()
                },1500);
                Object.keys(this.flag_tabs).forEach(key => this.flag_tabs[key] = false);
                this.flag_tabs[tab] = true;
                sessionStorage.setItem('tab_panel' , tab);

            },

            /*from register component*/

            getInitializeData: function(){
                axios.get('/api/register/initial').then(res=>{
                    this.createYearsLoop(res.data.year);
                    this.majors = res.data.majors;
                    this.provinces = res.data.provinces;
                    this.dorms = res.data.dorms;
                }).catch(err=>{
                    console.log(err);
                })
            },

            createYearsLoop: function (year) {
                for (var i=year; i>=1370; i--){
                    this.yearsLoop.push(i);
                }
            },

            selectFocus: function (number) {
                this.flag_titleShow = number;
            },

            selectUnFocus: function () {
                this.flag_titleShow = '';
            },

            showCities: function (type=null) {
                var provinceId = '';
                if (type === 'born'){
                    provinceId = this.v_provinceBorn.value
                    this.v_cityBorn = ''
                    this.v_subCityBorn = ''
                } else {
                    provinceId = this.v_province.value
                    this.v_city = ''
                    this.v_subCity = ''
                }
                axios.get('/api/register/getCities/' + provinceId).then(res=>{
                    if (type === 'born'){
                        this.citiesBorn = res.data.cities;
                    } else {
                        this.cities = res.data.cities;
                    }
                }).catch(err=>{
                    console.log(err);
                })
            },

            showSubCities: function (type=null) {
                var cityId = '';
                if (type === 'born'){
                    this.v_subCityBorn = ''
                    cityId = this.v_cityBorn.value
                } else {
                    this.v_subCity = ''
                    cityId = this.v_city.value
                }

                axios.get('/api/register/getSubCities/' + cityId).then(res=>{
                    if (type === 'born'){
                        this.subCitiesBorn = res.data.subCities;
                    } else {
                        this.subCities = res.data.subCities;
                    }
                }).catch(err=>{
                    console.log(err);
                })
            },

            showMajors: function (type=null) {
                if (type === 'now'){
                    this.v_major = '';
                } else if (type === 'end1'){
                    this.v_majorEnd1 = '';
                } else  if (type === 'end2'){
                    this.v_majorEnd2 = '';
                } else if (type === 'end3'){
                    this.v_majorEnd3 = '';
                }

            },

            addMajor: function (number) {
                if (number === 1){
                    this.flag_addMajor1 = true;
                } else if (number === 2){
                    this.flag_addMajor2 = true;
                }
            },

            /**vue validate**/
            validateBeforeSubmit() {
                this.$validator.validateAll();
            },

            /**image croppa**/
            upload() {
                if (!this.croppa.hasImage()) {
                    alert('no image to upload')
                    return
                }

                this.croppa.generateBlob((blob) => {
                    var fd = new FormData()

                    fd.append('file', blob, this.fileName)
                    fd.append('other', 'blahblahblah')
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'http://localhost:8000/api/upload',
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            alert(data)
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

            changeCity:function () {
                this.flag_changeCity = true;
            },

            changeAvatar:function () {
                this.flag_changeAvatar = true;
            },

            changeBirthCity:function () {
                this.flag_changeBirthCity = true;
            },

            showMorePosts:function(){

                this.flag_loader = true;
                setTimeout(() => {
                    this.flag_loader = false;
                    this.postItems = this.postItems + 15;
                    if (this.postItems >= this.user.posts.length){
                        this.flag_hasMore = false;
                    }
                }, 2500);
            },

        }
    }
</script>
