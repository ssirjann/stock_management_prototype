			var i = 1;
 			$('#add_guitar').click(function add_guitar() {
				var $form = '<div id="guitar' + i + '" class="col-sm-6 guitar_detail">';
				$form += '<label class="control-label">Guitar</label>';
				$form += '<select id="guitar_id"'+i+' name="guitar_id'+i+ '" class="form-control">'
			 	
				$form += $output;

			 	$form += '</select>';



			 	$form += '<label class="control-label">Make date</label>';
			 	$form += '<input placeholder="YYYY/MM/DD" class="form-control" type="date" name="make_date' + i + '" value="">';

			 	$form += '<label class="control-label">Colour</label>';
			 	$form += '<input class="form-control" type="text" name="colour' +i+ '" value="">';

			 	$form += '<label class="control-label">Quantity</label>';
			 	$form += '<input class="form-control" type="number" name="quantity' +i+ '" value="">';

			 	$form += '<input class="form-control" type="hidden" name="no_of_guitars" value="'+ ++i +'">';

			 	$('#guitars').append($form);
			});

			$('#remove_guitar').click(function remove_gitar() {
				if(i>1) {
					$('#guitar'+(i-1)).remove();
					console.log($('#guitar'+i));
					--i;
				}
			});

 			$('#supplier').on('keyup', function () {
			 	$val = ($('#supplier').val());
 				$sug = "";
			 	$.post('supplier_lookup.php', {val: $val}).done(function (message) {
			 		$message = JSON.parse(message);
 					for(var key in $message) {
 						$key=key;
 						$sug += "<li>" + $key+": " + $message[key] + "</li>";
 					}
 					$('$supplier_suggestion').html($sug);
			 	});
		 	});

 			$('.guitar').on('keyup', function () {
 				$id = this.id;

 				console.log($('#'+$id).val());
 				val = $('#'+$id).val()
 				$.post('guitar_lookup.php', {val:val}).done(function (data) {
 					console.log(data);
 						$data = JSON.parse(data);
 						$array = new Array();
 						for(key in $data) {
 							$array[key] = $data[key];
 						}
 						$a='';
 						for(key in $array) {
 							$a+="<li class=\"suggestion_item " + $id+"_suggestion \" id="+ key+">"+key+": "+ $array[key] +"</li>"
 						}
 						$('#'+$id+"_suggestion").html($a);
 						$("#"+$id+"_suggestion").css({"width": $("#"+$id).css('width'), "display" : "inherit"});

			 			$('.'+$id+'_suggestion').mousedown(function () {
			 				$("#"+$id).val($(this).html());
			 				$("input[name="+$id+"]").attr('value', this.id);
			 				$(".suggestion").html('');
			 				$(".suggestion").css('display', 'none');
			 			})

	 			});
	 			$('.guitar').blur(function () {
			 				$(".suggestion").html('');
			 				$(".suggestion").css('display', 'none');	 				
	 			})


	 		});