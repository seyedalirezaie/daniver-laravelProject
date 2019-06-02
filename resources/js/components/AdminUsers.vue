<template>

    <div>

        <div class="col col-xl-12 order-xl-8 col-lg-12 order-lg-3 col-md-12 col-sm-12 col-12">
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12 table-responsive">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>شناسه</th>
                                                <th>نام</th>
                                                <th>وضعیت تحصیلی</th>
                                                <th>وضعیت کاربری</th>
                                                <th>تاریخ عضویت</th>
                                                <th>نقش ها</th>
                                                <th>دسترسی ها</th>
                                                <th>تصویر پروفایل</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(user , index) in users" role="row" class="odd">
                                                <td>{{index}}</td>
                                                <td>{{user.id}}</td>
                                                <td>{{user.family}}</td>
                                                <td>{{user.status}}</td>
                                                <td>{{user.active}}</td>
                                                <td>{{user.created_at}}</td>
                                                <td><ul>
                                                    <li v-if="user.roles.length > 0" v-for="role in user.roles">{{role.name}}</li>
                                                </ul></td>

                                                <td><ul>
                                                    <li v-if="user.roles.length > 0" v-for="role in user.roles">{{role.name}}</li>
                                                </ul></td>

                                                <td><img width="40px" v-if="user.photo" class="rounded circle" :src="'/images/sm/'+user.photo.path"></td>
                                                <td><a :href="'/administrator/user/'+user.id+'/permissions'" class="btn btn-sm btn-danger">ویرایش</a></td>
                                            </tr>
                                            </tbody>
                                        </table>

</div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
</section>
            </div>
        </div>


    </div>
</template>

<script>


    /*jquery inside vue component*/
    $(document).ready(function () {


    })



    export default {
        data(){
            return{
                users: []
            }
        },
        components: {

        },
        props: [

        ],

        watch : {

        },

        mounted() {
            this.getUsers();
        },

        methods: {

            getUsers:function () {
                axios.get('/api/administrator/users').then(res=>{
                    this.users = res.data.users;
                }).catch(err=>{
                    console.log(err);
                })
            }

        }
    }
</script>