<!-- Messenger Plugin chat Code -->
<!-- <div id="fb-root"></div> -->

<!-- Your Plugin chat code -->
<!-- <div id="fb-customer-chat" class="fb-customerchat">
    </div> -->

<!-- <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "109339624543408");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script> -->

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v13.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>
<script src="/assets/libs/feather-icons/feather.min.js"></script>
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- pace js -->
<script src="/assets/libs/pace-js/pace.min.js"></script>
<script>
    var baseurl = window.location.protocol + "//" + window.location.host;
    //notification
    function readnoti(id) {
        $.ajax({
            url: baseurl + '/admin/module/ajax-system.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                type: 'readnoti',
                noti_id: id
            },
            beforeSend: function() {
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Please wait...',
                    icon: 'info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: (data) => {
                if (data.error) {
                    Swal.fire("Thông báo", data.msg, "error");
                } else {
                    Swal.fire("Thông báo", data.msg, "info");
                }
            }
        });
    }



    function wait(t, e, n) {
        return e ? $(t).prop("disabled", !1).html(n) : $(t).prop("disabled", !0).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...')
    }
    // copyToClipboard
    function copyToClipboard(string) {
        let textarea;
        let result;

        try {
            textarea = document.createElement('textarea');
            textarea.setAttribute('readonly', true);
            textarea.setAttribute('contenteditable', true);
            textarea.style.position = 'fixed'; // prevent scroll from jumping to the bottom when focus is set.
            textarea.value = string;

            document.body.appendChild(textarea);

            textarea.focus();
            textarea.select();

            const range = document.createRange();
            range.selectNodeContents(textarea);

            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);

            textarea.setSelectionRange(0, textarea.value.length);
            result = document.execCommand('copy');
        } catch (err) {
            console.error(err);
            result = null;
        } finally {
            document.body.removeChild(textarea);
        }

        // manual copy fallback using prompt
        if (!result) {
            const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
            const copyHotkey = isMac ? '⌘C' : 'CTRL+C';
            result = prompt(`Press ${copyHotkey}`, string); // eslint-disable-line no-alert
            if (!result) {
                return false;
            }
        }
        return true;
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            hour = '' + d.getHours(),
            minutes = '' + d.getMinutes(),
            year = d.getFullYear();
        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        if (hour.length < 2)
            hour = '0' + hour;
        if (minutes.length < 2)
            minutes = '0' + minutes;
        var fulldate = year + '-' + month + '-' + day + ' ' + hour + ':' + minutes;
        return fulldate;
    }
</script>