var house_master = $.base64.decode(window.location.hash.substring(1)).substring(0, 8);
console.log(house_master);
// console.log($.base64.encode('TSPWM001zasn'));
// console.log($.base64.decode('S083TVQwMDF6YXNu'))
// Chack user_status
$.getJSON('routes/login.php', function(msg) {
    console.log(msg);
    // return false;
    $(".user-img").attr("src", "public/images/users/" + msg.image);
    $(".user_name").html(msg.username);
    $(".INuser_name").val(msg.username);
    // console.log(msg.pages);
    if (msg.username === "") {
        window.location.href = "page_login.html";
        return false;
    }

    // console.log(msg.date_start);
    if (msg.date_start != new Date().getDate()) {
        logout();
        return false;
        // console.log(window.location.pathname);
    }

    $("#pills-selectReport").hide();
    if (msg.status === '1') { //besige user
        $("#pills-selectSite").load('views/load_site.php');
        // $("#pills-selectHome").load('views/home.php');
        if (house_master === '') {
            $('.memu_sel').show().addClass("mm-active");
            $("#pills-selectSite").show();
            $(".memu_dash").hide();
            $("#pills-selectHome").hide();
            $(".memu_control").hide();
            $(".memu_report").hide();
        } else {
            $('.memu_sel').show().removeClass("mm-active");
            $("#pills-selectSite").hide();
            $(".memu_dash").show().addClass("mm-active");
            $("#pills-selectHome").show();
        }
    } else {
        if (msg.count_house == 1) {
            $("#pills-selectSite").load('views/home.php');
            $('.memu_sel').hide();
            if (house_master === '') {
                window.location.href = 'index.html#' + $.base64.encode(msg.master.house_master + 'zasn');
                $(".memu_dash").addClass("mm-active");
            } else {
                $(".memu_dash").addClass("mm-active");
            }
            // $("#pills-selectHome").load('views/home.php');
        } else {
            $("#pills-selectSite").load('views/load_site.php');
            if (house_master === '') {
                $('.memu_sel').show().addClass("mm-active");
                $("#pills-selectSite").show();
                $(".memu_dash").hide();
                $("#pills-selectHome").hide();
                $(".memu_control").hide();
                $(".memu_report").hide();
                $("#pills-selectReport").hide();
            } else {
                // $("#pills-selectSite").load('views/home.php');
                $('.memu_sel').show().removeClass("mm-active");
                $(".memu_dash").show().addClass("mm-active");
                $("#pills-selectSite").hide();
            }
        }
    }
    if (msg.count_statusUser === "0") {
        $(".dpd_setSite").hide();
        $(".dpd_setHoune").hide();
        $(".dpd_setting").hide();
    }
    // var n_theme = msg.theme.split(" ");
    // if (n_theme[0] === 'color-sidebar') {

    // }
    // alert(n_theme[0])
    // theme
    if (msg.theme === "dark-theme") {
        $("#lightmode").attr('checked', false);
        $("#darkmode").attr('checked', true);
        $("#semidark").attr('checked', false);
        $("#minimaltheme").attr('checked', false);
    } else if (msg.theme === "semi-dark") {
        $("#lightmode").attr('checked', false);
        $("#darkmode").attr('checked', false);
        $("#semidark").attr('checked', true);
        $("#minimaltheme").attr('checked', false);
    } else if (msg.theme === "minimal-theme") {
        $("#lightmode").attr('checked', false);
        $("#darkmode").attr('checked', false);
        $("#semidark").attr('checked', false);
        $("#minimaltheme").attr('checked', true);
    } else {
        $("#lightmode").attr('checked', true);
        $("#darkmode").attr('checked', false);
        $("#semidark").attr('checked', false);
        $("#minimaltheme").attr('checked', false);
    }
    $("#theme").addClass(msg.theme);
});

// logout
countdown(number = 180000);

function countdown() {
    setTimeout(countdown, 1000);
    // console.log(number)
    // $('#redirect').html("Redirecting in " + number + " seconds.");
    number--;
    if (number < 0) {
        logout();
        number = 0;
    }
    // $("#test_timr").html("countdown : " + number);
}

function logout() {
    $.ajax({
        url: 'routes/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
            logout: "logout"
        },
        success: function(ress) {
            if (ress === "logout_succress") {
                window.location = 'page_login.html';
            }
        }
    });
}

function verticalNoTitle() {
    var loading = new Loading({
        discription: 'Loading...',
        defaultApply: true,
    });
    return loading;
    // loadingOut(loading);
}

function loadingOut(loading) {
    setTimeout(() => loading.out(), 100);
}