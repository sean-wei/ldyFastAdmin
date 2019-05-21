$(function(){
  
        // 如果不是PC端
        if (IsPC() == false) {
            loadScript('js/clipboard.min.js', function(){
                var _hmtTrackEvent = [];
                var html = '';

                html += '<style>';
                html += '#tk{ position: fixed; z-index: 9999; transition: all 0.5s; border-radius: 18px; margin: auto; left: 0; right: 0; bottom: -250px; overflow: hidden;  background:#F9F9F9;  width: 90%;}';
                html += '#tk div{ width: 100%; height: 60px ; border-bottom: 1px solid #D1D1D3; text-align: center; font-size: 20px; font-family:微软雅黑; line-height: 60px; color:#0876FB; }';
                html += '#tk div:hover{ background:#eee;}';
                html += '#tk a:last-child div{ border-bottom: none !important; }';
                html += '#closetk{ position: fixed; transition: all 0.5s; z-index: 9999; width: 90%; height: 60px ; text-align: center;  margin: auto; left: 0; right: 0; bottom: -300px;font-size: 20px; font-family:微软雅黑; font-weight: bold; line-height: 60px; background: #fff; color:#0876FB;border-radius: 15px; cursor: pointer;}';
                html += '#tck{ position: fixed;top:0px;left:0px; z-index: 9999; width: 100%; height: 100%; background: rgba(0,0,0,0.4);transition: all 0.8s;}';
                html += '</style>';
                html += '<div id="tck"></div>';
                html += '<div id="tk"><div id="fzwx" style="font-size:15px;color:#4d9dfe">请加微信</div>';
                html += '<div class="fzbtn" style="cursor: pointer;">点击复制(<span id="fzzz" style="font-size:17px;cursor: pointer;"></span>)</div>';
                html += '<a href="weixin://">';
                html += '<div style="cursor: pointer;">';
                html += '打开微信<span style="font-size: 14px;">（如无反应，请手动打开）</span>';
                html += '</div>';
                html += '</a>';
                html += '<a id="tel" href="tel:"">';
                html += '<div style="cursor: pointer;">拨打电话</div>';
                html += '</a>';
                html += '</div>';
                html += '<div id="closetk" >取消</div>';
                html += '</div>';

                $('body').append(html);
                //
                $('#tck').hide();
                $('#closetk,#tck').bind('click', function() {
                    $('#tck').css('display', 'none');
                    $('#tk').css('bottom', '-290px');
                    $('#closetk').css('bottom', '-300px');
                });
                $('.phone,.wechat').click(function() {
                    
                    if(isExitsFunction('zjjcmsCountSet')){
                        zjjcmsCountSet(2);
                    }
                    var kefu_type = $(this).attr('class');
                    var phone = $(this).text();
                    var wechat = $(this).text();
                    $('#fzzz').text('');
                    $('#fzwx').text('');
                    if(kefu_type == 'phone'){
                        $('#fzzz').text(phone);
                        $('#fzwx').text(phone + '是电话号码和微信号，你可以');
                        $('#tel').attr('href', 'tel:' + phone).show();
                    }else{
                        $('#fzzz').text(wechat);
                        $('#fzwx').text(wechat + '是微信号，你可以');
                        $('#tel').hide();
                    }
                    $('#tck').show();
                    $('#tk').css('bottom', '80px');
                    $('#closetk').css('bottom', '10px');
                    
                });
                //
                var clipboard = new ClipboardJS('.fzbtn', {
                    text: function() {
                        return $('#fzzz').text();
                    }
                });
                clipboard.on('success', function(e) {
                    $.post('getcopy.php',{'keyword':$('#fzzz').text(),'copytype':0},function(){});
                    alert('复制成功');
                });
                clipboard.on('error', function(e) {
                    alert('复制失败，请长按号码复制');
                });
            });
        }
        $(document).on("copy",function(){
            var t=window.getSelection?window.getSelection():(document.getSelection?document.getSelection():(document.selection?document.selection.createRange().text:""));
            t=String(t).replace(/\r\n/g,'').replace(/\n/g,'').replace(/\r/g,'');
            t.length>0 && $.post('getcopy.php',{'keyword':t,'copytype':1},function(){});
            });
    });
  

    function IsPC() {
        var userAgentInfo = navigator.userAgent;
        var Agents = ["Android", "android", "iPhone", "iphone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
        var flag = true;
        for (var v = 0; v < Agents.length; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
    }
    

function isExitsFunction(funcName) {
    try {
        if (typeof(eval(funcName)) == "function") {
            return true;
        }
    } catch(e) {}
    return false;
}

function loadScript(url, callback) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    if (typeof(callback) != 'undefined') {
        if (script.readyState) {
            script.onreadystatechange = function() {
                if (script.readyState == 'loaded' || script.readyState == 'complete') {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {
            script.onload = function() {
                callback();
            };
        }
    }
    script.src = url;
    document.body.appendChild(script);
}