define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'ldy_server/index' + location.search,
                    add_url: 'ldy_server/add',
                    edit_url: 'ldy_server/edit',
                    del_url: 'ldy_server/del',
                    multi_url: 'ldy_server/multi',
                    table: 'ldy_server',
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
                        {field: 'pid', title: ('落地页标题')},
                        {field: 'nickname', title: __('Nickname')},
                        {field: 'phone', title: __('Phone')},
                        {field: 'photo', title: __('Photo'), formatter:Table.api.formatter.images,events: Table.api.events.img},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'update_time', title: __('Update_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            // 给上传按钮添加上传成功事件
            $("#plupload-ldy-server").data("upload-success", function (data) {
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



        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});