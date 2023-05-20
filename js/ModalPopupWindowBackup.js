var popup_modalPopupWindow = null;

function CreateModalPopUpObject() {
    if (popup_modalPopupWindow == null) {
        popup_modalPopupWindow = new ModalPopupWindow();
    }
    return popup_modalPopupWindow;
}

function ModalPopupWindow() {
    var strOverLayHTML = '<div id="popup_div_overlay" onmousemove="popup_modalPopupWindow.DoDragging(event)" onmouseup="popup_modalPopupWindow.StopDragging()" style="position:absolute;z-index:10; background-color:WHITE; filter: alpha(opacity = 70);opacity:0.7;"></div><div id="popup_div_frame_parent" style="position:absolute;z-index:12; display:none;background-color:white;border:1px solid;-moz-box-shadow: 0 0 10px 10px #BBB;-webkit-box-shadow: 0 0 10px 10px #BBB;box-shadow: 0 0 10px 10px #BBB;"><table width="100%" border="0" cellpadding="0" cellspacing="0" onmouseup="popup_modalPopupWindow.StopDragging()"><tr style="background-color:Gray;" id="popup_tr_title" onmousedown="popup_modalPopupWindow.StartDragging(event,this)" onmousemove="popup_modalPopupWindow.DoDragging(event)" onmouseup="popup_modalPopupWindow.StopDragging()"><td align="left"><span id="popup_span_title" style="color:White;font-size:9pt;padding-left:2px"></span></td><td  align="right" style="height:25px;"><span id="popup_span_overlay_window_max" style="display:none" onclick="Maximisze();" style="cursor:pointer">max</span><span onclick="popup_modalPopupWindow.HideModalPopUp();" style="cursor:pointer"> <img id="popup_img_overlay_close"  src="" alt="X" </span></td></tr><tr ><td colspan="2" align="center" width="100%" id="popup_td_overlay"><div id="popup_div_message" style="margin-top:20px;display:none;"  ><span id="popup_span_message" style="padding-left:40px;padding-top:10px;padding-bottom:10px; font-size:9pt;"  ></span></div><span id="popup_span_loading"><img id="popup_img_overlay_loading" src="" alt="Loading..." /></span><iframe onload="popup_modalPopupWindow.OnUrlLoaded()" name="popup_overlay_frame" id="popup_overlay_frame" src="/Blank.htm" frameborder="0" scrolling="auto" ></iframe> </td></tr><tr id="popup_tr_overlay_btn" ><td colspan="2" align="center" style="padding-top:20px;padding-bottom:10px;"><input type="button" id="pupop_btn_overlay_1" onclick="popup_modalPopupWindow.HideModalPopUp()" value="Ok" style="padding:3px; border:1 solid #dcdcdc;BACKGROUND-COLOR: #f5f5f5;"   /><input type="button" id="popup_btn_overlay_2" onclick="popup_modalPopupWindow.HideModalPopUp()" value="Cancel" style="padding:3px;margin-left:20px;border:1 solid #dcdcdc;BACKGROUND-COLOR: #f5f5f5;"   /> </td></tr></table></div>';
    var orginalHeight;
    var orginalWidth;
    var btnStyle = "";
    var maximize = false;
    document.write(strOverLayHTML);
    this.Draggable = true;


    function Maximisze() {
        if (!maximize) {
            maximize = true;
            ResizePopUp(window.screen.availHeight - 200, window.screen.availWidth - 50);
        } else {
            maximize = false;
            ResizePopUp(orginalHeight, orginalWidth);
        }
    }

    function ResizePopUp(height, width) {
        var divFrameParent = document.getElementById("popup_div_frame_parent");
        var divOverlay = document.getElementById("popup_div_overlay");
        var iframe = document.getElementById("popup_overlay_frame");
        var tdOverLay = document.getElementById("popup_td_overlay");
        var left = (window.screen.availWidth - width) / 2;
        var top = (window.screen.availHeight - height) / 2;
        var xy = GetScroll();
        if (maximize) {
            left = xy[0] + 10;
            top = xy[1] + 10;
        } else {
            left += xy[0];
            top += xy[1];
        }
        divFrameParent.style.top = top + "px";
        divFrameParent.style.left = left + "px";
        divFrameParent.style.height = height + "px";
        divFrameParent.style.width = width + "px";
        iframe.style.height = divFrameParent.offsetHeight - 60 + "px";
        iframe.style.width = divFrameParent.offsetWidth - 2 + "px";
    }
    var onPopUpCloseCallBack = null;
    var callbackArray = null;
    this.SetLoadingImagePath = function(imagePath) {
        document.getElementById("popup_img_overlay_loading").src = imagePath;
    }
    this.SetCloseButtonImagePath = function(imagePath) {
        document.getElementById("popup_img_overlay_close").src = imagePath;
    }

    this.SetButtonStyle = function(_btnStyle) {
        btnStyle = _btnStyle;
    }

    function ApplyBtnStyle() {
        if (btnStyle == "")
            return;
        var styles = btnStyle.split(';');
        for (var i = 0; i < styles.length; i++) {
            var style = styles[i].split(':');
            var objBtn1 = document.getElementById("pupop_btn_overlay_1");
            var objBtn2 = document.getElementById("popup_btn_overlay_2");
            eval("pupop_btn_overlay_1.style." + style[0] + "='" + style[1] + "';");
            eval("popup_btn_overlay_2.style." + style[0] + "='" + style[1] + "';");
        }
    }

    function __InitModalPopUp(height, width, title) {
        orginalWidth = width;
        orginalHeight = height;
        maximize = false;
        var divFrameParent = document.getElementById("popup_div_frame_parent");
        var divOverlay = document.getElementById("popup_div_overlay");
        var iframe = document.getElementById("popup_overlay_frame");
        var tdOverLay = document.getElementById("popup_td_overlay");
        var left = (window.screen.availWidth - width) / 2;
        var top = (window.screen.availHeight - height) / 2;
        var xy = GetScroll();
        left += xy[0];
        top += xy[1];
        document.getElementById("popup_tr_overlay_btn").style.display = "none";
        document.getElementById("popup_span_title").innerHTML = title;
        divOverlay.style.top = "0px";
        divOverlay.style.left = "0px";
        var e = document;
        var c = "Height";
        var maxHeight = Math.max(e.documentElement["client" + c], e.body["scroll" + c], e.documentElement["scroll" + c], e.body["offset" + c], e.documentElement["offset" + c]);
        c = "Width";
        var maxWidth = Math.max(e.documentElement["client" + c], e.body["scroll" + c], e.documentElement["scroll" + c], e.body["offset" + c], e.documentElement["offset" + c]);
        divOverlay.style.height = maxHeight + "px";
        divOverlay.style.width = maxWidth - 2 + "px";
        divOverlay.style.display = "";
        iframe.style.display = "none";
        divFrameParent.style.display = "";
        //$('#divFrameParent').animate({ opacity: 1 }, 2000);
        divFrameParent.style.top = top + "px";
        divFrameParent.style.left = left + "px";
        divFrameParent.style.height = height + "px";
        divFrameParent.style.width = width + "px";
        iframe.style.height = "0px";
        iframe.style.width = "0px";
        document.getElementById("pupop_btn_overlay_1").style.width = "";
        document.getElementById("popup_btn_overlay_2").style.width = "";
        onPopUpCloseCallBack = null;
        callbackArray = null;
    }

    this.ShowURL = function(url, height, width, title, onCloseCallBack, callbackFunctionArray, maxmizeBtn) {
        __InitModalPopUp(height, width, title);
        var divFrameParent = document.getElementById("popup_div_frame_parent");
        var divOverlay = document.getElementById("popup_div_overlay");
        var iframe = document.getElementById("popup_overlay_frame");
        var tdOverLay = document.getElementById("popup_td_overlay");
        tdOverLay.style.height = divFrameParent.offsetHeight - 20 + "px";
        tdOverLay.style.width = divFrameParent.offsetWidth - 2 + "px";
        document.getElementById("popup_span_loading").style.display = "";
        document.getElementById("popup_div_message").style.display = "none";
        //iframe.src = url;
        iframe.style.height = divFrameParent.offsetHeight - 60 + "px";
        iframe.style.width = divFrameParent.offsetWidth - 2 + "px";
        setTimeout("popup_modalPopupWindow.LoadUrl('" + url + "')", 1);
        if (onCloseCallBack != null && onCloseCallBack != '') {
            onPopUpCloseCallBack = onCloseCallBack;
        }
        if (callbackFunctionArray != null && callbackFunctionArray != '') {
            callbackArray = callbackFunctionArray;
        }
        if (maxmizeBtn) {
            document.getElementById("popup_span_overlay_window_max").style.display = "";
        }
    }

    this.ShowMessage = function(message, height, width, title) {
        __InitModalPopUp(height, width, title);
        document.getElementById("popup_tr_overlay_btn").style.display = "";
        var tdOverLay = document.getElementById("popup_td_overlay");
        tdOverLay.style.height = "50px";
        tdOverLay.style.width = "0px";
        document.getElementById("popup_span_message").innerHTML = message;
        document.getElementById("popup_div_message").style.display = "";
        document.getElementById("popup_span_loading").style.display = "none";
        document.getElementById("pupop_btn_overlay_1").value = "OK";
        document.getElementById("pupop_btn_overlay_1").onclick = popup_modalPopupWindow.HideModalPopUp;
        document.getElementById("popup_btn_overlay_2").style.display = "none";
        ApplyBtnStyle();
    }
    this.ShowConfirmationMessage = function(message, height, width, title, onCloseCallBack, firstButtonText, onFirstButtonClick, secondButtonText, onSecondButtonClick) {
        this.ShowMessage(message, height, width, title);
        var tdOverLay = document.getElementById("popup_td_overlay");
        var maxWidth = 100;
        document.getElementById("popup_span_message").innerHTML = message;
        document.getElementById("popup_div_message").style.display = "";
        document.getElementById("popup_span_loading").style.display = "none";
        if (onCloseCallBack != null && onCloseCallBack != '') {
            onPopUpCloseCallBack = onCloseCallBack;
        }
        if (firstButtonText != "") {
            document.getElementById("pupop_btn_overlay_1").value = firstButtonText;
            if (onFirstButtonClick != "") {
                document.getElementById("pupop_btn_overlay_1").onclick = onFirstButtonClick;
            }
        }
        if (secondButtonText != "") {
            document.getElementById("popup_btn_overlay_2").value = secondButtonText;
            document.getElementById("popup_btn_overlay_2").style.display = "";
            if (onSecondButtonClick != null && onSecondButtonClick != "") {
                document.getElementById("popup_btn_overlay_2").onclick = onSecondButtonClick;
            }
        }
        if (firstButtonText != "" && secondButtonText != "") {
            if (document.getElementById("pupop_btn_overlay_1").offsetWidth > document.getElementById("popup_btn_overlay_2").offsetWidth) {
                document.getElementById("popup_btn_overlay_2").style.width = document.getElementById("pupop_btn_overlay_1").offsetWidth + "px";
            }
            if (document.getElementById("popup_btn_overlay_2").offsetWidth > document.getElementById("pupop_btn_overlay_1").offsetWidth) {
                document.getElementById("pupop_btn_overlay_1").style.width = document.getElementById("popup_btn_overlay_2").offsetWidth + "px";
            }
        }

        ApplyBtnStyle();
    }
    this.LoadUrl = function(url) {
        document.getElementById("popup_overlay_frame").src = url;
    }

    this.OnUrlLoaded = function() {
        document.getElementById("popup_overlay_frame").style.display = "";
        document.getElementById("popup_span_loading").style.display = "none";
    }

    function ShowLoading() {
        document.getElementById("popup_overlay_frame").style.display = "none";
        document.getElementById("popup_span_loading").style.display = "";
    }
    this.HideModalPopUp = function() {
        var divFrameParent = document.getElementById("popup_div_frame_parent");
        var divOverlay = document.getElementById("popup_div_overlay");
        divOverlay.style.display = "none";
        divFrameParent.style.display = "none";
        this.Draggable = true;
        if (onPopUpCloseCallBack != null && onPopUpCloseCallBack != '') {
            onPopUpCloseCallBack();
        }
    }
    this.CallCallingWindowFunction = function(index, para) {
        callbackArray[index](para);
    }
    this.ChangeModalPopUpTitle = function(title) {
        document.getElementById("popup_span_title").innerHTML = title;
    }

    function setParentVariable(variableName, variableValue) {
        window[String(variableName)] = variableValue;
    }

    function GetScroll() {
        if (window.pageYOffset != undefined) {
            return [pageXOffset, pageYOffset];
        } else {
            var sx, sy, d = document,
                r = d.documentElement,
                b = d.body;
            sx = r.scrollLeft || b.scrollLeft || 0;
            sy = r.scrollTop || b.scrollTop || 0;
            return [sx, sy];
        }
    }

    //========Dragging Logic======================
    var dragging = false,
        dragTop = 0,
        dragLeft = 0;

    this.DoDragging = function(e, undefined) {
        if (!this.Draggable) return;
        if (dragging == false) return;
        var __div_frame_parent = document.getElementById("popup_div_frame_parent");

        var top = parseInt(__div_frame_parent.style.top.replace('px', ''));
        var left = parseInt(__div_frame_parent.style.left.replace('px', ''));

        var currentX = 0,
            currentY = 0;
        if (e.pageX != undefined) {
            currentX = e.pageX;
            currentY = e.pageY;
        } else if (e.x != undefined) {
            currentX = e.x;
            currentY = e.y;
        }

        if (currentY > dragTop) {
            top += currentY - dragTop;
        } else {
            top -= dragTop - currentY;
        }

        if (currentX > dragLeft) {
            left += currentX - dragLeft;
        } else {
            left -= dragLeft - currentX;
        }

        dragTop = currentY;
        dragLeft = currentX;
        try {
            __div_frame_parent.style.top = top + "px";
            __div_frame_parent.style.left = left + "px";
        } catch (ex) {}
    }

    this.StartDragging = function(e, _this) {
        if (!this.Draggable) return;
        dragging = true;
        dragTop = e.pageY;
        dragLeft = e.pageX;
        _this.style.cursor = 'move';
    }

    this.StopDragging = function() {
        if (!this.Draggable) return;
        dragging = false;
        document.getElementById("popup_tr_title").style.cursor = 'default';
    }

}