$(function(){
	//图片上传
	$('#img').on('click',function(e){
		$('#uploadField').click();
	});

	$('#uploadField').on('change',function(e){

		var $file = $(this)[0].files[0];
 		// alert($file);
		//将图片放到缩略图
		var reader = new FileReader();

		reader.readAsDataURL($file);

		reader.onload=function(){
			$('.img-thumbnail').attr('src',reader.result);
		};
 	});


	//多图
	$('#imgs').on('click',function(e){
		$('#uploadFields').click();
	});

	$('#uploadFields').on('change',function(e){

		var $file = $(this)[0].files[0];
 		alert($file);
		//将图片放到缩略图
		var reader = new FileReader();

		reader.readAsDataURL($file);
		alert($file);
		reader.onload=function(){
			$('.img-thumbnail1').attr('src',reader.result);
			$('.img-thumbnail2').attr('src',reader.result);
			$('.img-thumbnail3').attr('src',reader.result);
		};
 	});






	//全选
	$('#checkall').change(function(e){
		var $checked = $(this).prop('checked');
		var $obj = $('input[name="id[]"');
		$obj.prop('checked',$checked);
		// console.log($obj);
	});

	$('#checkorno').click(function(e){
		var checkall = $('#checkall');
		var checked = checkall.prop('checked');
		checked = checked ? false : true;
		checkall.prop('checked',checked);
		var $obj = $('input[name="id[]"');
		$obj.prop('checked',checked);
	})


	// $('#delall').click(function(e){
	// 	// 是否需选择id
	// 	var obj = $('input[name="id[]"]:checked');
	// 	if(obj.length < 1){
	// 		alert("请选择要删除的记录");
	// 		return;
	// 	}

	// 	var ids = [];
	// 	$.each(obj,function(index){
	// 		ids.push($(this).val());
	// 	});


	// 	// ids=ids.join(',');
	// 	console.log(ids);
	// 	return;
	// 	$.ajax({
	// 		headers:{
	// 			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').prop('content')
	// 		},
	// 		url: '/delall',
	// 		type: 'post',
	// 		data: {ids:ids},
	// 		async: true,
	// 		success: function(res){

	// 		},
	// 		errror: function(){

	// 		}
	// 	});
	// });
 	
});








