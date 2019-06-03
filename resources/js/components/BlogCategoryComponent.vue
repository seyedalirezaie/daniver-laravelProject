<template>

    <div>

        <div class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">دسته بندی های وبلاگ</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="col col-5 col-md-5">

                <!-- /.box-header -->
                <div v-for="(category , index) in categories" class="box-body" style="">

                    <div class="box box-default box-solid collapsed-box expandable-element">
                        <div class="box-header with-border">
                            <input class="box-title fs1-4" v-model="category.title">

                            <i @click="deleteItem(category.id , index)" class="fa fa-fw fa-trash text-danger fs2 cursor-pointer"></i>

                            <div v-if="category.children_recursive.length > 0" class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div v-if="category.children_recursive.length > 0" v-for="(child , index) in category.children_recursive" class="box-body fs1-4" style="display: none;">
                            <input class="box-title fs1-4" v-model="child.title">
                            <i @click="deleteSubItem(child.id , category.id , index)" class="fa fa-fw fa-trash text-danger fs2 cursor-pointer"></i>
                        </div>

                        <!-- /.box-body -->
                    </div>

                </div>


                </div>

            </div>
        </div>

    </div>
</template>

<script>

    import {AtomSpinner} from 'epic-spinners'


    export default {
        data(){
            return{
                categories: [],
                itemsForDelete: [],
                type: 'blog'
            }
        },
        components: {
            AtomSpinner
        },
        props: [
        ],

        watch : {

        },

        mounted() {
            this.getCategories();
        },

        methods: {
            getCategories:function () {
                axios.get('/administrator/api/categories/blog').then(res => {
                    this.categories = res.data.categories;
                }).catch(err => {
                    console.log(err);
                })
            },

            deleteItem:function (categoryId , index) {
                this.categories.splice(index , 1);
                this.delete(categoryId);

            },

            deleteSubItem:function (categoryId  , parentId , index) {
                this.itemsForDelete.push(category);
                for (var i=0; i<this.categories.length; i++){
                    if (this.categories[i].id === parentId){
                        this.categories[i].children_recursive.splice(index , 1);
                    }
                }
                this.delete(categoryId);
            },

            delete:function (itemId) {
                axios.post('/administrator/api/categories/delete' , {
                    'type':this.type,
                    'itemsForDelete':itemId,
                }).then(res => {
                }).catch(err => {
                    console.log(err);
                })
            }

        }
    }
</script>