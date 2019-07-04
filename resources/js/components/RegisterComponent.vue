<template>

    <div>

        <div dir="rtl" class="col col-xl-12 order-xl-2 col-lg-12 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
            <div class="ui-block">
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-1">
                    اطلاعات اولیه
                </div>
                <div class="ui-block-content">


                    <!-- Personal Information Form  -->

                    <form>
                        <div dir="rtl" class="row">

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3 notice-register-container">
                                <div class="notice-register container">
                                    توجه: برای ثبت نام در سایت تنها پر کردن <span class="btn btn-primary mb-0" @click="showRequired()">موارد ستاره دار</span> الزامی است هرچند پرکردن بقیه موارد کمک می کند تا دوستانتان شناخت بهتری نسبت به شما داشته باشند.
                                </div>
                            </div>


                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">* نام
                                        <span v-show="errors.has('name')" class="text-primary">{{ errors.first('name') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" v-validate="'required'" name="name" class="form-control" placeholder="" type="text" v-model="reg_name">
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label text-dan">* ایمیل
                                        <span v-show="errors.has('email')" class="text-primary">{{ errors.first('email') }}</span>
                                        <span v-if="emailUniqueError" class="text-primary">(این ایمیل قبلا توسط کاربر دیگری ثبت شده است)</span>
                                    </label>
                                    <input v-validate="'required|email'" class="form-control" :class="{'bg-required-field' : flag_justRequiredFields}" placeholder="" name="email" type="text" v-model="reg_email">
                                    <span class="material-input"></span></div>


                                <div class="form-group label-floating">
                                    <label class="control-label">* رمز عبور
                                        <span v-show="errors.has('password')" class="help is-danger text-primary">{{ errors.first('password') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" ref="password" v-validate="'required|min:6'" name="password" class="form-control" placeholder="" type="password" v-model="reg_password">
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


                                <div class="form-group label-floating">
                                    <label class="control-label">* تکرار رمز عبور
                                        <span v-show="errors.has('password_confirmation')" class="help is-danger text-primary">{{ errors.first('password_confirmation') }}</span>
                                    </label>
                                    <input :class="{'bg-required-field' : flag_justRequiredFields}" data-vv-as="password" v-validate="'required|confirmed:password'" name="password_confirmation" v-model="reg_cPassword" class="form-control" placeholder="" type="password">
                                    <span class="material-input"></span></div>

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
                                    <div class="form-group label-floating is-empty">
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

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3 notice-register-container">
                                <div class="notice-register container">
                                <span>توجه: در حالت اولیه شماره موبایل شما در معرض عموم قرار نخواهد گرفت اما اگر شما تمایل به نمایش آن دارید گزینه زیر را علامت بزنید</span>
                                <div class="from-group mt-3">
                                <input v-model="v_settingShowMobile" class="d-inline-block input-width-unset" type="checkbox">
                                <span class="mb-3">شماره موبایل من در سایت نمایش داده شود.</span>
                                </div>
                                </div>
                            </div>


                            <!--province city-->

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                محل سکونت خانواده(منظور محل سکونت دانشجویی نیست)
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 1" class="control-label">استان محل زندگی</label>
                                    <v-select v-bind:disabled="v_liveForeign" @input="showCities()" v-model="v_province" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(1)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 2" class="control-label">شهرستان محل زندگی</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" @input="showSubCities()" v-model="v_city" dir="rtl" :searchable=true :value.sync="selected" :options=cities @search:blur="selectUnFocus()" @search:focus="selectFocus(2)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 3" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:label="label" v-bind:disabled="v_liveForeign" v-model="v_subCity" dir="rtl" :searchable=true :value.sync="selected" :options=subCities @search:blur="selectUnFocus()" @search:focus="selectFocus(3)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <input v-model="v_liveForeign" class="d-inline-block input-width-unset" type="checkbox">
                                <span class="mb-3">خارج از کشور</span>

                                <div v-if="v_liveForeign" class="form-group label-floating mt-3">
                                    <label class="control-label">نام کشور محل سکونت خانواده خود را وارد کنید</label>
                                    <input class="form-control" placeholder="" type="text" v-model="reg_liveForeign">
                                    <span class="material-input"></span></div>

                            </div>

                            <!--end province city-->

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                تصویر پروفایل
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">

                                <input type="range" @input="onSliderChange" :min="sliderMin" :max="sliderMax" step=".001" v-model="sliderVal">

                                <croppa @file-choose="handleFileChoose" @zoom="onZoom"  v-model="croppa" @new-image-drawn="onNewImage"
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

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                اطلاعات دانشجویی
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">

                                <div class="form-group">
                                    <input value="now" name="type" v-model="flag_userStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>در حال حاضر دانشجوی دانشگاه ولی عصر (عج) رفسنجان هستم.</span>
                                </div>

                                <div class="form-group">
                                    <input value="end" name="type" v-model="flag_userStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>فارغ التحصیل دانشگاه ولی عصر (عج) رفسنجان هستم و اکنون دانشجو نیستم.</span>
                                </div>

                                <div class="form-group">
                                    <input value="end-now" name="type" v-model="flag_userStatus" class="d-inline-block input-width-unset" type="radio">
                                    <span>فارغ التحصیل دانشگاه ولی عصر (عج) رفسنجان هستم و اکنون در دانشگاه دیگری در حال تحصیلم.</span>
                                </div>
                            </div>

                            <!--now major-->



                            <div class="container-fluid" v-if="flag_userStatus === 'now'">
                                <div class="row">

                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">
                                        * رشته ای که اکنون در آن تحصیل می کنید را انتخاب کنید
                                    </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div :class="{'bg-required-field' : flag_justRequiredFields}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==4" class="control-label">دانشکده</label>
                                    <v-select v-bind:disabled="flag_disabled" label="titles" @input="showMajors('now')" v-model="v_college" dir="rtl" :searchable=true :value.sync="selected" :options=majors @search:blur="selectUnFocus()" @search:focus="selectFocus(4)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div :class="{'bg-required-field' : flag_justRequiredFields}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==5" class="control-label">رشته ی تحصیلی
                                    <span v-if="majorNowRequiredError && flag_userStatus === 'now'" class="text-primary">(انتخاب رشته ی تحصیلی الزامی است)</span>
                                    </label>
                                    <v-select v-bind:disabled="flag_disabled" label="titles" v-model="v_major" dir="rtl" :searchable=true :value.sync="selected" :options=v_college.children_recursive @search:blur="selectUnFocus()" @search:focus="selectFocus(5)"><span slot="no-options">ابتدا دانشکده را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div :class="{'bg-required-field' : flag_justRequiredFields}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==6" class="control-label">سال ورود
                                        <span v-if="yearNowRequiredError && flag_userStatus === 'now'" class="text-primary">(انتخاب سال ورود الزامی است)</span>
                                    </label>
                                    <v-select v-bind:disabled="flag_disabled" label="label" v-model="v_yearNow" dir="rtl" :searchable=true :value.sync="selected" :options=yearsLoop @search:blur="selectUnFocus()" @search:focus="selectFocus(6)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                                </div>
                            </div>

                            <!--end now major-->


                            <!--add major 1-->

                            <div class="container-fluid">
                                <div class="row">

                            <div v-if="flag_userStatus === 'now'" class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">
                                اگر قبلا از رشته های دانشگاه ولی عصر فارغ التحصیل شده اید آن ها را انتخاب کنید و در غیر این صورت این مورد را رها کنید
                            </div>

                                    <div v-else class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">
                                        * رشته ای که از آن در دانشگاه ولی عصر (عج) رفسنجان فارغ التحصیل شده اید را انتخاب کنید
                                    </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div :class="{'bg-required-field' : flag_isRequired}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==7" class="control-label">دانشکده</label>
                                    <v-select label="titles" @input="showMajors('end1')" v-model="v_college_end1" dir="rtl" :searchable=true :value.sync="selected" :options=majors @search:blur="selectUnFocus()" @search:focus="selectFocus(7)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div :class="{'bg-required-field' : flag_isRequired}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==8" class="control-label">رشته ی تحصیلی
                                        <span v-if="majorEnd1RequiredError && flag_userStatus !== 'now'" class="text-primary">(انتخاب رشته ی فارغ التحصیلی الزامی است)</span>
                                    </label>
                                    <v-select label="titles" v-model="v_majorEnd1" dir="rtl" :searchable=true :value.sync="selected" :options=v_college_end1.children_recursive @search:blur="selectUnFocus()" @search:focus="selectFocus(8)"><span slot="no-options">ابتدا دانشکده را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-10 col-12">
                                <div :class="{'bg-required-field' : flag_isRequired}" class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==9" class="control-label">سال ورود
                                        <span v-if="yearEnd1RequiredError && flag_userStatus !== 'now'" class="text-primary">(انتخاب سال ورود الزامی است)</span>
                                    </label>
                                    <v-select label="label" v-model="v_yearEnd1" dir="rtl" :searchable=true :value.sync="selected" :options=yearsLoop @search:blur="selectUnFocus()" @search:focus="selectFocus(9)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div v-if="v_yearEnd1 !== '' && v_majorEnd1 !== ''" @click="addMajor(1)" class="col col-lg-1 col-md-1 col-sm-2 cursor-pointer text-center add-major-end">
                                <span>افزودن</span>
                                <i class="fas fa-plus-square"></i>
                            </div>

                                </div>
                            </div>

                            <!--end add major 1-->


                            <!--add major 2-->

                            <div class="container-fluid" v-if="flag_addMajor1">

                            <div class="row">

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==10" class="control-label">دانشکده</label>
                                    <v-select label="titles" @input="showMajors('end2')" v-model="v_college_end2" dir="rtl" :searchable=true :value.sync="selected" :options=majors @search:blur="selectUnFocus()" @search:focus="selectFocus(10)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==11" class="control-label">رشته ی تحصیلی</label>
                                    <v-select label="titles" v-model="v_majorEnd2" dir="rtl" :searchable=true :value.sync="selected" :options=v_college_end2.children_recursive @search:blur="selectUnFocus()" @search:focus="selectFocus(11)"><span slot="no-options">ابتدا دانشکده را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-3 col-md-3 col-sm-10 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==12" class="control-label">سال ورود</label>
                                    <v-select label="label" v-model="v_yearEnd2" dir="rtl" :searchable=true :value.sync="selected" :options=yearsLoop @search:blur="selectUnFocus()" @search:focus="selectFocus(12)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div v-if="v_yearEnd2 !== '' && v_majorEnd2 !== ''" @click="addMajor(2)" class="col col-lg-1 col-md-1 col-sm-2 cursor-pointer text-center add-major-end">
                                <span>افزودن</span>
                                <i class="fas fa-plus-square"></i>
                            </div>

                            </div>

                            </div>

                            <!--end add major 2-->

                            <!--add major 3-->

                            <div class="container-fluid" v-if="flag_addMajor2">

                                <div class="row">

                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                        <div class="form-group label-floating is-select">
                                            <label v-if="flag_titleShow !==13" class="control-label">دانشکده</label>
                                            <v-select label="titles" @input="showMajors('end3')" v-model="v_college_end3" dir="rtl" :searchable=true :value.sync="selected" :options=majors @search:blur="selectUnFocus()" @search:focus="selectFocus(13)"></v-select>
                                            <span class="material-input"></span></div>
                                    </div>
                                    <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label v-if="flag_titleShow !==14" class="control-label">رشته ی تحصیلی</label>
                                            <v-select label="titles" v-model="v_majorEnd3" dir="rtl" :searchable=true :value.sync="selected" :options=v_college_end3.children_recursive @search:blur="selectUnFocus()" @search:focus="selectFocus(14)"><span slot="no-options">ابتدا دانشکده را انتخاب کنید.</span></v-select>
                                            <span class="material-input"></span></div>
                                    </div>

                                    <div class="col col-lg-3 col-md-3 col-sm-10 col-12">
                                        <div class="form-group label-floating is-select">
                                            <label v-if="flag_titleShow !==15" class="control-label">سال ورود</label>
                                            <v-select label="label" v-model="v_yearEnd3" dir="rtl" :searchable=true :value.sync="selected" :options=yearsLoop @search:blur="selectUnFocus()" @search:focus="selectFocus(15)"></v-select>
                                            <span class="material-input"></span></div>
                                    </div>

                                </div>

                            </div>

                            <!--end add major 3-->


                            <div class="container-fluid">
                                <div class="row">


                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3" v-if="flag_userStatus === 'end-now'">
                                        مشخصات رشته و دانشگاهی که اکنون در آن تحصیل می کنید را در این قسمت بنویسید

                                        <div class="form-group label-floating mt-3 label-color">
                                            <label class="control-label">مثال: زبان و ادبیات فارسی - کارشناسی ارشد - دانشگاه تهران - ورودی
                                            {{yearsLoop[0] - 1}}
                                            </label>
                                            <input v-model="reg_otherNow" class="form-control" placeholder="" type="text">
                                            <span class="material-input"></span></div>

                                    </div>


                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">
                                            اگر قبلا از دانشگاه دیگری جز دانشگاه ولی عصر فارغ التحصیل شده اید در این قسمت بنویسید

                                        <div class="form-group label-floating mt-3 label-color">
                                            <label class="control-label">مثال: مهندسی برق - کارشناسی - دانشگاه باهنر کرمان - ورودی 1390 / مهندسی برق - کارشناسی ارشد - دانشگاه صنعتی اصفهان - ورودی 1395 </label>
                                            <input class="form-control" placeholder="" type="text" v-model="reg_otherEnd">
                                            <span class="material-input"></span></div>

                                    </div>

                                </div>
                            </div>

                            <div v-if="flag_userStatus === 'now'" class="col col-lg-12 col-md-12 col-sm-12 col-12 p-3 mb-3">

                                <h6>وضعیت سکونت دانشجویی خود را مشخص کنید</h6>
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


                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 bg-grey-title rounded p-3 mb-3">
                                اطلاعات متفرقه
                            </div>

                            <!--born province city-->

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                زادگاه خود را مشخص کنید
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12 select-edit state-select">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==17" class="control-label">استان</label>
                                    <v-select v-bind:disabled="v_fromForeign" @input="showCities('born')" v-model="v_provinceBorn" dir="rtl" :searchable=true :value.sync="selected" :options=provinces @search:blur="selectUnFocus()" @search:focus="selectFocus(17)"></v-select>
                                    <span class="material-input"></span></div>
                            </div>
                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !==18" class="control-label">شهرستان</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" @input="showSubCities('born')" v-model="v_cityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=citiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(18)"><span slot="no-options">ابتدا استان را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label v-if="flag_titleShow !== 19" class="control-label">شهر/بخش</label>
                                    <v-select v-bind:disabled="v_fromForeign" v-bind:label="label" v-model="v_subCityBorn" dir="rtl" :searchable=true :value.sync="selected" :options=subCitiesBorn @search:blur="selectUnFocus()" @search:focus="selectFocus(19)"><span slot="no-options">ابتدا شهرستان را انتخاب کنید را انتخاب کنید.</span></v-select>
                                    <span class="material-input"></span></div>
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
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

                            <!--end born province city-->




                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">توضیح کوتاهی در مورد خودتان بنویسید</label>
                                    <textarea v-model=v_selfDescription class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label">کتاب های مورد علاقه؟</label>
                                    <textarea v-model="v_favorites_book" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label">سایر چیزها و کارهای مورد علاقه؟</label>
                                    <textarea v-model="v_favorites" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label">رزومه، سوابق، شغل و ...</label>
                                    <textarea v-model="cv" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>






                            </div>
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">

                                <div class="form-group label-floating">
                                    <label class="control-label">موسیقی، آهنگ و خواننده مورد علاقه؟</label>
                                    <textarea v-model="v_favorites_music" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label">فیلم سینمایی و سریال مورد علاقه؟</label>
                                    <textarea v-model="v_favorites_movie" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>

                                <div class="form-group label-floating">
                                    <label class="control-label">مهارت های فنی، هنری، علمی و ...</label>
                                    <textarea v-model="v_skills" class="form-control" placeholder=""></textarea>
                                    <span class="material-input"></span></div>


                            </div>
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

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                <span class="btn btn-green btn-lg" @click="submitForm()">ثبت نام</span>
                            </div>

                        </div>
                    </form>

                    <!-- ... end Personal Information Form  -->
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    /**multi select for tags**/
    import Multiselect from 'vue-multiselect'
    // register globally
    Vue.component('multiselect', Multiselect)

    /**select by search**/
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)

    import 'vue-select/dist/vue-select.css';

    /**vue validation**/
    const customMessages = {
        custom: {
            'email': {
                required: ' (وارد کردن ایمیل الزامی است) ',
                email: ' (ایمیل وارد شده صحیح نیست) '
            },

            'password': {
                required: ' (رمز عبور نمی تواند خالی باشد) ',
                min: ' (رمز عبور باید حداقل 6 کاراکتر باشد) '
            },

            'password_confirmation': {
                confirmed: ' (رمز عبور با تکرار آن مطابقت ندارد) ',
                required: ' (تکرار رمز عبور نمی تواند خالی باشد) '
            },

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
                yearsLoop: [],
                majors: [],
                birthday: '',
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
                flag_userStatus: 'now',
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
                reg_name: '',
                reg_lastName: '',
                reg_email: '',
                reg_password: '',
                reg_cPassword: '',
                reg_alias: '',
                reg_phone: '',

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
                changeImage: false

            }
        },
        components: {
            Multiselect,
            datePicker: VuePersianDatetimePicker,

        },
        props: [

        ],
        mounted() {
            this.getInitializeData();

            /**vue validate**/
            this.$validator.localize('en', customMessages);


            this.croppa.addClipPlugin(function (ctx, x, y, w, h) {
                ctx.beginPath()
                ctx.arc(x + w / 2, y + h / 2, w / 2, 0, 2 * Math.PI, true)
                ctx.closePath()
            })

        },

        watch : {
            reg_email:function(val) {
                if (val === sessionStorage.getItem('uniqueEmail')) {
                    this.emailUniqueError = true;
                } else {
                    this.emailUniqueError = false;
                }
            },

            reg_alias:function(val) {
                if (val === sessionStorage.getItem('uniqueAlias')) {
                    this.aliasUniqueError = true;
                } else {
                    this.aliasUniqueError = false;
                }
            },

            v_major:function(val) {
                if (val === '') {
                    this.majorNowRequiredError = true;
                } else {
                    this.majorNowRequiredError = false;
                }
            },

            v_yearNow:function(val) {
                if (val === '') {
                    this.yearNowRequiredError = true;
                } else {
                    this.yearNowRequiredError = false;
                }
            },

            v_majorEnd1:function(val) {
                if (val === '') {
                    this.yearEnd1RequiredError = true;
                } else {
                    this.yearEnd1RequiredError = false;
                }
            },

            v_yearEnd1:function(val) {
                if (val === '') {
                    this.yearEnd1RequiredError = true;
                } else {
                    this.yearEnd1RequiredError = false;
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

            getInitializeData: function(){
                axios.get('/api/panel/initial').then(res=>{
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
                axios.get('/api/panel/getCities/' + provinceId).then(res=>{
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

                axios.get('/api/panel/getSubCities/' + cityId).then(res=>{
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

            submitForm: function () {

                this.$Progress.start();

                if (this.reg_email === '') {
                    this.reg_email = ''
                }
                if (this.reg_name === '') {
                    this.reg_name = ''
                }
                if (this.reg_lastName === '') {
                    this.reg_lastName = ''
                }
                if (this.reg_password === '') {
                    this.reg_password = ''
                }
                if (this.reg_cPassword === '') {
                    this.reg_cPassword = ''
                }




                var gender = '';
                if (this.v_gender === 'مرد'){
                    gender = 1;
                } else {
                    gender = 0;
                }

                if (this.v_liveForeign){
                    this.v_province = '';
                    this.v_city = '';
                    this.v_subCity = '';
                }

                if (this.flag_userStatus === 'now'){
                    this.reg_otherNow = '';
                }

                if (this.flag_userStatus === 'end'){
                    this.v_major = '';
                    this.v_yearNow = '';
                    this.reg_otherNow = '';
                }

                if (this.flag_userStatus === 'end-now'){
                    this.v_major = '';
                    this.v_yearNow = '';
                }

                if (this.dormStatus !== 'dorm-vru'){
                    this.v_dorm = '';
                }

                if(this.v_fromForeign){
                    this.v_provinceBorn = ''
                    this.v_cityBorn = ''
                    this.v_subCityBorn = ''
                }

                this.accounts = {
                    'telegram' : this.account_telegram,
                    'instagram' : this.account_instagram,
                    'linkedin' : this.account_linkedin,
                    'accountEmail' : this.account_email,
                    'facebook' : this.account_facebook,
                    'twitter' : this.account_twitter,
                }

                axios.post('/register' , {
                    'name' : this.reg_name,
                    'email' : this.reg_email,
                    'password' : this.reg_password,
                    'password_confirmation' : this.reg_cPassword,
                    'last_name' : this.reg_lastName,
                    'alias' : this.reg_alias,
                    'phone' : this.reg_phone,
                    'liveForeign' : this.reg_liveForeign,
                    'isLiveForeign' : this.v_liveForeign,
                    'birthday' : this.birthday,
                    'gender' : gender,
                    'provinceLive' : this.v_province.value,
                    'cityLive' : this.v_city.value,
                    'subCityLive' : this.v_subCity.value,
                    'userStatus' : this.flag_userStatus,
                    'majorNow' : this.v_major.id,
                    'yearNow' : this.v_yearNow,
                    'majorEnd1' : this.v_majorEnd1.id,
                    'yearEnd1' : this.v_yearEnd1,
                    'majorEnd2' : this.v_majorEnd2.id,
                    'yearEnd2' : this.v_yearEnd2,
                    'majorEnd3': this.v_majorEnd3.id,
                    'yearEnd3': this.v_yearEnd3,
                    'majorOtherNow': this.reg_otherNow,
                    'majorOtherEnd': this.reg_otherEnd,
                    'dormStatus': this.dormStatus,
                    'dorm': this.v_dorm.id,
                    'birthPlaceProvince': this.v_provinceBorn.value,
                    'birthPlaceCity': this.v_cityBorn.value,
                    'birthPlaceSubCity': this.v_subCityBorn.value,
                    'isBornedForeign' : this.v_fromForeign,
                    'foreignBirthPlace' : this.v_foreignBirthPlace,
                    'school1' : this.v_school1,
                    'school2' : this.v_school2,
                    'school3' : this.v_school3,
                    'selfDescription' : this.v_selfDescription,
                    'favorites' : this.v_favorites,
                    'cv' : this.cv,
                    'accounts' : this.accounts,
                    'skills' : this.v_skills,
                    'favorites_book' : this.v_favorites_book,
                    'favorites_music' : this.v_favorites_music,
                    'favorites_movie' : this.v_favorites_movie


                }).then(res=>{
                    this.$Progress.finish();
                    this.upload();
                }).catch(err=>{

                 /*   this.$notify({
                        group: 'reg',
                        type: 'warn',
                        duration: 20000,
                        text: 'پر کردن تمام موارد ستاره دار برای ثبت نام الزامی است'
                    })*/

                    if (this.reg_email === '') {
                        this.reg_email = ''
                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'ایمیل خود را وارد کنید'
                        })
                    }
                    if (this.reg_name === '') {
                        this.reg_name = ''
                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'نام خود را وارد کنید'
                        })
                    }
                    if (this.reg_lastName === '') {
                        this.reg_lastName = ''
                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'نام خانوادگی خود را وارد کنید'
                        })
                    }
                    if (this.reg_password === '') {
                        this.reg_password = ''
                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'رمز عبور خود را وارد کنید'
                        })
                    }
                    if (this.reg_cPassword === '') {
                        this.reg_cPassword = ''
                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'تکرار رمز عبور خود را وارد کنید'
                        })
                    }

                    console.log(err.response.data.errors);

                    if (err.response.data.errors){
                        alert('error');
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
                        sessionStorage.setItem('uniqueAlias' , this.reg_alias)
                    }

                    if (err.response.data.errors.majorNow) {

                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'لطفا رشته ی تحصیلی خود را وارد کنید'
                        })

                        this.majorNowRequiredError = true;
                    }

                    if (err.response.data.errors.yearNow) {

                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'لطفا سال ورود به رشته ی تحصیلی خود را نیز وارد کنید'
                        })

                        this.yearNowRequiredError = true;
                    }

                    if (err.response.data.errors.majorEnd1) {

                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'لطفا رشته ی فارغ التحصیلی خود را از دانشگاه ولی عصر وارد کنید'
                        })

                        this.majorEnd1RequiredError = true;
                    }

                    if (err.response.data.errors.yearEnd1) {

                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'لطفا سال ورود به رشته ی تحصیلی را که از آن فارغ التحصیل شده اید نیز وارد کنید'
                        })

                        this.yearEnd1RequiredError = true;
                    }

                    if (err.response.data.errors.email[0] === 'The email has already been taken.') {

                        this.$notify({
                            group: 'reg',
                            type: 'error',
                            duration: 20000,
                            text: 'ایمیلی که وارد کرده اید قبلا توسط کاربر دیگری در سایت استفاده شده است'
                        })

                        this.emailUniqueError = true;
                        sessionStorage.removeItem('uniqueEmail');
                        sessionStorage.setItem('uniqueEmail' , this.reg_email);
                    }

                })
            },

            /**vue validate**/
            validateBeforeSubmit() {
                this.$validator.validateAll();
            },

            /**image croppa**/
            upload() {
                this.$Progress.start();
                if (!this.croppa.hasImage()) {
                    window.location.href = '/';
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
                        url: '/api/upload',
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            window.location.href = '/';
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









        }
    }
</script>

<!--multi select for tags style-->
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>