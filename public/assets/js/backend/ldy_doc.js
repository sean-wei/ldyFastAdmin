define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ldy_doc/index' + location.search,
                    add_url: 'ldy_doc/add',
                    edit_url: 'ldy_doc/edit',
                    del_url: 'ldy_doc/del',
                    multi_url: 'ldy_doc/multi',
                    table: 'ldy_doc',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        // {field: 'uid', title: __('Uid')},
                        // {field: 'name', title: __('Name')},
                        {field: 'nickname', title: __('Nickname')},
                        {field: 'photo', title: __('Photo'),formatter:Table.api.formatter.images},
                        {field: 'ldy_id', title: ('所属落地页')},
                        // {field: 'group_id', title: __('Group_id')},
                        // {field: 'description', title: __('Description')},
                        // {field: 'root', title: __('Root')},
                        // {field: 'pid', title: __('Pid')},
                        // {field: 'model_id', title: __('Model_id')},
                        // {field: 'type', title: __('Type')},
                        // {field: 'position', title: __('Position')},
                        // {field: 'link', title: __('Link')},
                        // {field: 'display', title: __('Display')},
                        // {field: 'deadline', title: __('Deadline')},
                        // {field: 'attach', title: __('Attach')},
                        // {field: 'view', title: __('View')},
                        // {field: 'comment', title: __('Comment')},
                        // {field: 'extend', title: __('Extend')},
                        // {field: 'level', title: __('Level')},
                        // {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'status', title: __('Status')},
                        {field: 'operate', title: __('Operate'), table: table,

                            buttons:[

                                {
                                    name: 'addDocReply',
                                    text: '添加问答',
                                    title: '问答管理',
                                    icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-dialog',
                                    url: '/admin/ldy_doc/addDocReply'
                                },

                                {
                                    name: 'docReplyList',
                                    text: '问答管理',
                                    title: '问答管理',
                                    // icon: 'fa fa-plus',
                                    classname: 'btn btn-xs btn-primary btn-addtabs',
                                    url: '/admin/ldy_doc/ListDocReply'
                                },


                            ],

                            events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            // 给上传按钮添加上传成功事件
            $("#plupload-ldydoc-server").data("upload-success", function (data) {
                alert('upload photo');
                var url = Backend.api.cdnurl(data.url);
                $(".profile-server-img").prop("src", url);
                Toastr.success("上传成功！");

            });

        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        docReplyList:function(){
            Controller.api.bindevent();
        },
        addDocReply:function(){
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});