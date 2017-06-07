$(document).ready(function(){
	$("#basic-addon3").text(location.hostname+"/");
});

var xmlHTTP =new XMLHttpRequest();

function check(){
    var url = $("#customurl").val();
		if(url){
				xmlHTTP.open("GET","check.php?url="+url,true);
				xmlHTTP.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							$("#notify").removeClass("invisible");
							if (xmlHTTP.responseText===("y")){
									//顯示圈圈
								$(".badge-success").show();
								$(".badge-danger").hide();
							}
							else {
								//顯示叉
								$(".badge-danger").show();
								$(".badge-success").hide();
							}
						}
    		};
		}
		else $("#notify").addClass("invisible");
};

function test() {
    var linkkey = "test";
    xmlHTTP.open("GET", "get.php?linkkey=" + linkkey, true);
    xmlHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $("#input").val = xmlHTTP.responseText;
        }
    }
}

function get(){
    var linkkey = location.search.split("?")[1];
    xmlHTTP.open("GET", "get.php?linkkey=" + linkkey, true);
    xmlHTTP.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $("#input").val = xmlHTTP.responseText;
        }
    }
};