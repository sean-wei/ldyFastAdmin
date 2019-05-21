define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ldy_main/index' + location.search,
                    add_url: 'ldy_main/add',
                    edit_url: 'ldy_main/edit',
                    del_url: 'ldy_main/del',
                    multi_url: 'ldy_main/multi',
                    table: 'ldy_main',
                }
            });

            var table = $("#table");
            var type = __('Type') ==="list" ? "列表" : '';


            /**
             *   初始化表格
             *   -------------
             *   配置：
             *   operate:false//不显示搜索栏
             *
             */
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                showToggle: false,//关闭切换卡片视图和表格视图两种模式功能
                showColumns: false,//关闭快速切换字段列的显示和隐藏功能

                columns: [
                    [
                        {checkbox: true},
                        {field: 'sort', title: __('Sort'),operate:false},
                        {field: 'title', title: __('Title')},
                        // {field: 'meta_title', title: __('Meta_title')},
                        {field: 'keywords', title: __('Keywords')},
                        // {field: 'description', title: __('Description')},
                        // {field: 'thumb_size', title: __('Thumb_size')},
                        // {field: 'template_index', title: __('Template_index')},
                        {field: 'template_lists', title: __('Template_lists')},
                        // {field: 'template_detail', title: __('Template_detail')},
                        // {field: 'template_edit', title: __('Template_edit')},
                        // {field: 'model', title: __('Model')},
                        // {field: 'type', title: __('Type')},
                        // {field: 'link', title: __('Link')},
                        // {field: 'allow_publish', title: __('Allow_publish')},
                        // {field: 'display', title: __('Display')},
                        // {field: 'reply', title: __('Reply')},
                        // {field: 'check', title: __('Check')},
                        // {field: 'reply_model', title: __('Reply_model')},
                        // {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'view', title: __('View')},
                        // {field: 'status', title: __('Status')},
                        // {field: 'icon', title: __('Icon'), formatter: Table.api.formatter.icon},
                        // {field: 'is_inherit', title: __('Is_inherit')},
                        // {field: 'water_enable', title: __('Water_enable')},
                        {field: 'operate', title: __('Operate'), table: table,


                            //添加按钮：
                            buttons:[
                                {
                                    name: 'ldyPreview',
                                    text: '预览',
                                    title: '落地页预览',
                                    // extend:' target="_blank"',//新标签页
                                    extend: 'data-area=\'["375px","667px"]\' data-shade=\'[0.5,"#000"]\'',
                                    classname: 'btn btn-xs btn-success btn-dialog',
                                    url: '/index/preview_ldy/index'
                                },

                                {
                                    name: 'ldyCopy',
                                    text: '复制落地页',
                                    title: '复制落地页',
                                    extend:' target="_blank"',//新标签页
                                    classname: 'btn btn-xs btn-success btn-addtabs',
                                    url: '/admin/ldy_main/ldyCopy'
                                },

                                {
                                    name: 'listLdyServer',
                                    text: '客服列表',
                                    title: '客服列表',
                                    // icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-addtabs',
                                    url: '/admin/ldy_main/listLdyServer'
                                },

                                {
                                    name: 'docList',
                                    text: '文章列表',
                                    title: '文章列表',
                                    // icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-addtabs',
                                    url: '/admin/ldy_main/docList'
                                },

                                {
                                    name: 'addServer',
                                    text: '添加客服',
                                    title: '添加客服',
                                    icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    url: '/admin/ldy_main/addServer'
                                },

                                {
                                    name: 'addDoc',
                                    text: '添加文章',
                                    title: '添加文章',
                                    icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    url: '/admin/ldy_main/addDoc'
                                },

                            ],

                            events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },

        //绑定操作事件
        addServer: function(){
            Controller.api.bindevent();
            // Fast.api.open();
        },
        //绑定操作事件
        listLdyServer: function(){
            Controller.api.bindevent();
            // Fast.api.open();
        },
        //绑定操作事件
        docList: function(){
            Controller.api.bindevent();
            // Fast.api.open();
        },
        //绑定操作事件
        addDoc: function(){
            Controller.api.bindevent();
            // Fast.api.open();
        },
        //绑定操作事件
        ldyPreview: function(){
            Controller.api.bindevent();
            // Fast.api.open();
        },
        ldyCopy:function(){
            Controller.api.bindevent();
            Form.api.bindevent();
        },


        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});