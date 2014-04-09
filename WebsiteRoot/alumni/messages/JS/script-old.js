/**
	string replace
	syntax: string replace(string v [, Number start, Number end]);
	parameters,
		v: source string
		start: starting of the replacement
		end: end of the replacement
	return value: returns a string after replacing the specified character
	#Note: does not changes the original string

	Example:
		x = "Some string";
		x.replace("new String"); // new String
		x.replace("new String", 3,5); // Somnew Stringtring
		x.replace("new String", 3); //Somnew String
*/
	// String.prototype.replace = function (v, start, end){
	//     str = this;
	//     start = (start)? start : 0;
	//     end = (end)? end : v.length;
	//     return str.substring(0, start) + v + str.substring(end+1);
	// }

var selectedList = {};
var curText = "";
var searchFormExist = false;
var maxSem=0;
var removeSelected = function (el){
	id = $(el).find("input[name='recpt[]']").val();
	selectedList[id] = false;
	$("#"+id+".response-name").removeClass("disabled");
	el.parentNode.removeChild(el);
}
var selectRecpt = function(el){
	if(selectedList[el.id])
		return;
	selectedList[el.id] = true;
	$("#response").append($('<span style="margin: 5px 10px; border-radius: 5px; display: inline-block; border: 1px solid #aaa;"><span style="padding: 5px; display:inline-block;" title="'+el.id+'">'+el.innerHTML+'</span><input type="hidden" name="recpt[]" value="'+el.id+'" /><span style="" class="close" onclick="removeSelected(this.parentNode)">&#10006;</span></span>'));
	$(el).addClass("disabled");
}
$(document).ready(function(){
	$(document.forms).submit(function(e){
		e.preventDefault();
	});

	$("input[name='submit_message']").click(function(e){
		// alert();
		e.preventDefault();
		if($("input[value='bl']")[0].checked){
			alert("Bulk message.")

		} else if($("input[value='sl']")[0].checked){
			alert("Selective message.")
		} else{
			// alert("none");
		}
	});

	window.utils = {
		DEVEL: 1,
		alertC: function(str){
			if(this.DEVEL)
				console.log(str);
		},
		alertD: function (str, head) {
		    if (str) {
		        if (head)
		            var head = $('<h2 class="alert-dialog-head" style="border-bottom: 1px solid #ccc; padding: 10px; padding-bottom: 0px; min-width: 300px; max-width: 600px;">' + head + '</h2>');
		        var body = $('<p class="alert-dialog-body" style="padding: 10px; margin: 0px; background-color: #EEE; padding: 5px 20px; min-width: 300px; max-width: 600px;">' + str + '</p>')
		    } else {
		        var body = $('<p class="alert-dialog-body" style="padding: 10px; margin: 0px; background-color: #EEE; padding: 5px 20px; min-width: 300px; max-width: 600px;"></p>')
		    }
		    alertContainer = $('<DIV style="position: fixed; z-index: 100000; left: 50%; top: 50%; box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.3); padding: 20px 10px; background-color: #eee; max-height: 600px; overflow: auto;"></DIV>');
		    closeButton = $('<BUTTON class="dialog-close-button" style="border: 0px; margin: auto; display: block; padding: 3px 10px;">Ok</BUTTON>')

		    shadow = $('<DIV class="drop-shadow" style="z-index: 1000000; position: fixed; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></DIV>');
		    $(document.body) .append(shadow);
		    $(shadow).append(alertContainer);
		    if (head)
		       alertContainer.append(head);
		    alertContainer.append(body);
		    alertContainer.append(closeButton);
		    closeDialog = function(){
		        document.body.removeChild(shadow[0]);
		        delete shadow;
		        delete alertContainer;
		        delete closeButton;
		    }
		    $(closeButton).click(closeDialog);
		    $(shadow).click(closeDialog);
		    var cont = alertContainer[0];
		    cont.style.top = Math.floor((window.innerHeight - cont.clientHeight)/2)+"px";
		    cont.style.left = Math.floor((window.innerWidth - cont.clientWidth)/2)+"px";
		    return {
		          container: alertContainer, 
		          shadow: shadow
		       };
		},
		enumerateList: function (list){
			str =  "";
			for(var x in list){
				str += '<span class="enumerationItem">' + x + ': ' + list[x] + '</span>';
			}

		},
	    enumerate: function (Obj, level) {
			level = (level)?level:1;

		    var type = typeof Obj;
		    if(type == "array" || type=="object"){
		        if(type=='array')
		            var str = "(" + type + ") " + " [" + Obj.length + "] {\n";
		        
		        if(type=="object" && Obj.length)
		            var str = type + " (" + Obj.length + ") {\n";
	            else
	                var str = type + " {\n";

		        for(var key in Obj) {
		            str += this.tabs(level) + this.enumerate(key, level+1) + ": " + this.enumerate(Obj[key], level+1) + "\n";
		        }

		        return str + this.tabs(level-1)+"}";
		    }
		    else if(type=='string')
		        return "(" + type + ") " + '(' + Obj.length + ") \"" + Obj+"\"";
		    else if(type=='function')
	            return "(" + type + ") " +" " + Obj;
	        else
		        return "(" + type + ") " +" " + Obj;
		},

	    tabs: function(n){
			var str = "";
			while(n--){
				str += "\t";
			}
			return str;
		},
		appendToBody: function(str, target){
			target = (target)? target: ".-mis-content";
			$(target).append(str);
		}
	};
	var zeros = function(n){
		var str = new String();
		while(n--){
			str += "0";
		}
		return str;
	}
	

	var getCourses = function () {

		$.ajax({
			url: "http://localhost/sfs3/WebsiteRoot/alumni/messages/module.php?a=getCourses",
			dataType: "json",
			cache: true,
			type: "post",
			success: function (response){
	            // window.str = response;
	            // return;
	            var str = '<div>'+"\n";
	            // window.str = response;
	            utils.alertC(utils.enumerate(response));
	            for(var x in response){
	            	str += "\t"+'<span style="display: block; margin: 3px;"><input type="checkbox" name="course[]" value="' + x + '" data-sem="'+response[x][1]+'">'+response[x][0]+'</input></span>'+"\n";
	            }
	            str += '</div>';
	            $("#course").html(str);
	            window.selectedCourses = new Array();
	            $('input[name="course[]"]').change(function(){
	            	var el = this;
	            	if(this.checked)
	            		window.selectedCourses.push(this.value);
	            	else
	            		delete window.selectedCourses[window.selectedCourses.indexOf(this.value)];
	            	//utils.alertC(utils.enumerate(el));
	            	// return;
	            	if(Number(this.attributes['data-sem'].nodeValue)>maxSem)
	            		maxSem = Number(this.attributes['data-sem'].nodeValue);

	            	if(this.branchiTimeout)
	            		clearTimeout(this.branchiTimeout);
	            	this.branchiTimeout = setTimeout(function(){
	            		getBranches();
	            	}, 1000);
	            });
			}
		});
	}
	var getBranches = function(){

		// var courses = JSON.stringify(window.selectedCourses);
		$.ajax({
			url: "http://localhost/sfs3/WebsiteRoot/alumni/messages/module.php?a=getBranch",
			dataType: "json",
			cache: true,
			type: "post",
			data: {courses: window.selectedCourses},
			success: function (response){
				// utils.alertC(response);
	            // utils.appendToBody(response);
	            // return;
	            utils.alertC(utils.enumerate(response));
	            if(response!=null){
	            	window.numBranch = response.length;
	            	var str = '<div>';
		            for(var x in response){
		            	if(Number(x)==NaN)
		            		continue;
		            	str += "\t"+'<span style="display: block; margin: 3px;"><input type="checkbox" name="branch[]" value="'+response[x][0]+'">'+response[x][1]+'</input></span>'+"\n";
		            }
		            str += '</div>';
		            $("#branch").html(str);
		            window.selectedBranches = new Array();
		            $("input[name='branch[]']").click(function(){
		            	window.selectedBranches.push(this.value);
		            });

		            // Create Semester checkboxes
		            var str = "<span>";
					for(var i=1; i<=maxSem; i++) {
						str += "\t"+'<span style="display: block; margin: 3px;"><input type="checkbox" name="sem[]" value="'+i+'">'+i+'</input></span>'+"\n";
					}
					str += "</span>";
					// utils.alertC(str);
					$("#sem").html(str);
					window.selectedSemester = new Array();
					$("input[name='sem[]']").click(function(){
			        	window.selectSemester.push(this.value);
			        });
		        } else {

		        }
			}
		});
	}
	function sendMessage(){
		var names = new Array();
		$(document.forms['names']['recpt[]']).each(function(){
		    names.push(this.value);
		});
		var msg = $("#msg-content").val();
		names = JSON.stringify(names);
		str = "";
		$.ajax({
		    url: "http://localhost/sfs3/WebsiteRoot/alumni/messages/module.php?a=insertMsg",
			cache: true,
			data: {message: msg, names: names},
			type: "post",
			success: function (response){
			str = response;
			}
	    });
	}
	function showSearchForm(){
		$("#bulk").hide();
		if(!searchFormExist){
			searchFormExist = true;
			searchForm = $('<div class="searchForm"><table><tr><td><input name="keyword" id="search-keyword" style="width: 400px;" autocomplete="off"/></td><td><input type="submit" name="submit"/></td></tr></table></div>');
			$("<tr><td id='searchForm' colspan='3' align='center'></td></tr><tr><td colspan='3'><form id='response' name='names'></form></td></tr>").insertBefore($("#new-msg table tr:last-child"));

			$("#searchForm").append(searchForm);
		}
		$("#searchForm").show();
		var i = 0;
		function check(str) {
			if(str !="")
				return true;
			else
				return false;
		}
		var searchName = function (keyword) {
			if(check(keyword)){
				if(keyword.trim()==curText.trim())
					return;
				curText = keyword;
				$.ajax({
					url: "http://localhost/sfs3/WebsiteRoot/alumni/messages/module.php?a=searchPeople&keyword="+keyword,
					dataType: "json",
					//cache: true,
					type: "post",
					data:{
						parstring: keyword
						},
					success: function (response){
							// alert(utils.enumerate(response));
						res = $("#searchForm");
						res.find("ul.responsetable").each(function(){
							this.parentNode.removeChild(this);
						});
						// $("#searchForm").remove("ul.responsetable");
						var responsetable = $('<ul class="responsetable" style="position: absolute; list-style: none; padding-top: 0px; border: 1px solid #ccc; padding-left: 0px; min-width: 300px;"></ul>');
						$("#search-keyword").parent().append(responsetable);
						// $("#search-keyword").parent().css("position", "relative");

						var length = 0;
						for(var i in response){
							length++;
							if(selectedList[i])
								responsetable.append($('<li id="' + i + '" title="'+i+'" class="response-name name'+length+' disabled" style="padding: 3px 20px; border-bottom: 1px solid #ccc;" onclick="selectRecpt(this)">' + response[i] + '</li>'));
							else
								responsetable.append($('<li id="' + i + '" title="'+i+'" class="response-name name'+length+'" style="padding: 3px 20px; border-bottom: 1px solid #ccc;" onclick="selectRecpt(this)">' + response[i] + '</li>'));
						
}						if(!length){
							$("#searchForm").append($("<ul class='responsetable'><li>No such name exists.</li></ul>"));
						}

					}
				});
                return true;
			} else {
				if(keyword!="")
					utils.alertD("Name or keyword contains invalid characters");
                return false;
			}			
		}
		$("#searchForm").keypress(function(e){
			if(e.keyCode==27){
				$("ul.responsetable").hide();
				return;
			}
		});
		$("#search-keyword").blur(function(){
			$("ul.responsetable").hide();
		});
		$("#search-keyword").focus(function(){
			$("ul.responsetable").show();
		});
		var responseI = 0;
		function selectResponse(ij){
			utils.alertC(ij);
			$("li.response-name.selected").removeClass("selected");
			$(".response-name.name"+ij).addClass("selected");
		}
		$(document.forms).submit(function(e){
			e.preventDefault();
		});
		$("#search-keyword").keydown(function(e){
			key = e.keyCode;
			UP = 38;
			DOWN = 40;
			if(key==UP)
				responseI = (responseI + 10 -2)%10 + 1;
			else if(key==DOWN)
				responseI = (responseI + 10)%10 + 1;
			else if(key==13){
				$(".response-name.name"+responseI).click();
			}
			selectResponse(responseI);

		});
		$("#search-keyword").keypress(function(e){
			if(e.keyCode==27){
				$("ul.responsetable").hide();
			}

			if(this.value.trim()==""){
				$("#searchForm").find("ul.responsetable").each(function(){
					this.parentNode.removeChild(this);
				});
				return;
			}

			if(i){
				searchName($("#search-keyword").val());
				// alert("something");
				i = 0;
				delete this.I;
			} else {
				if(this.I)
					return;
				this.I = setTimeout(function(){
					i = 1;
					// alert("something");
					$("#search-keyword").keypress();
				}, 1500);
			}
		});

		//utils.alertC(searchForm[0].outerHTML);
	}
	$("input[name=msg_type]").change(function(){
		if(this.value=="bl"){
			$("#bulk").show();
			$("#searchForm").hide();
			getCourses();
		}
		else if (this.value=="sl") {
			showSearchForm()
		}
	});
});