<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑博文</title>
    <link rel="stylesheet" href="__PUBLIC__/css/bootstrap.3.3.5.min.css"/>
    <link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/main_table.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/user-manage.css" />
	<script src="__PUBLIC__/js/jquery.js"></script>
	<script src="__PUBLIC__/js/bootstrap.3.3.5.min.js"></script>
    <script src="__PUBLIC__/js/ajaxupload.3.6.js"></script>
    <script type="text/javascript">
	    $(function(){
	    	//图片上传处理
		    var button = $('#upload_button'), interval;
		    var confirmdiv = $('#uploadphotoconfirm');
		    var fileType = "pic",fileNum = "one"; 
		    new AjaxUpload(button,{
		        action: "<?php echo U(GROUP_NAME . '/Article/uppic');?>",
		        name: 'userfile',
		        onSubmit : function(file, ext){
		            if(fileType == "pic")
		            {
		                if (ext && /^(jpg|png|jpeg|gif|JPG)$/.test(ext)){
		                    this.setData({
		                        'info': '文件类型为图片'
		                    });
		                } else {
		                     confirmdiv.text('文件格式错误，请上传格式为.png .jpg .jpeg 的图片');
		                    return false;               
		                }
		            }
		                        
		            confirmdiv.text('文件上传中');
		            
		            if(fileNum == 'one')
		                this.disable();
		            
		            interval = window.setInterval(function(){
		                var text = confirmdiv.text();
		                if (text.length < 14){
		                    confirmdiv.text(text + '.');                    
		                } else {
		                    confirmdiv.text('文件上传中');             
		                }
		            }, 200);
		        },
		        onComplete: function(file, response){
		            if(response != "success"){
		                if(response =='2'){
		                    confirmdiv.text("文件格式错误，请上传格式为.png .jpg .jpeg 的图片");
		                }else{
		                    if(response.length>20){
		                        confirmdiv.text("文件上传失败请重新上传"+response);            
		                    }else{
		                        confirmdiv.text("上传完成");
		                         $("#newbikephotoName").val("__ROOT__/Uploads/articles/"+response);
		                         $("#newbikephoto").attr("src","__ROOT__/Uploads/articles/"+response);            
		                    }
		                }
		                
		            }
		                                  
		            window.clearInterval(interval);
		                        
		            this.enable();
		            
		            if(response == "success")
		            alert('上传成功');              
		        }
		    });
	    });
    </script>	
	<script>
		window.UEDITOR_HOME_URL = '__ROOT__/App/Extends/Ueditor/';
		window.onload = function(){
			window.UEDITOR_CONFIG.initialFrameWidth = 900;  //初始化编辑器宽度,默认1000
			window.UEDITOR_CONFIG.initialFrameHeight = 600; //初始化编辑器高度,默认320
			window.UEDITOR_CONFIG.imageUrl = "<?php echo U(GROUP_NAME . '/Article/upload');?>"; /* 执行上传请求接口路径 */
			window.UEDITOR_CONFIG.imagePath = "__ROOT__/Uploads/" ; /*上传图片的修正地址*/
			UE.getEditor('J_content');  //实例化编辑器
		}
	</script>
	<script type="text/javascript" src="__ROOT__/App/Extends/Ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__ROOT__/App/Extends/Ueditor/ueditor.all.min.js"></script>
</head>
<body>
	<form>
		<div class="table-section">
			<h2 style="font-size:16px;font-weight:500;color:#000" data-id="<?php echo ($article["aid"]); ?>" id="getId"><span class="icon-edit">&nbsp</span>编辑博文</h2>
			<table class="mc-table mc-table-striped mc-table-hover">
		 		<tbody>
		 			<tr>
						<td class="table-head">博客标题</td>
						<td class="table-content"><input type="text" name="title" class="form-control" placeholder="<?php echo ($article["title"]); ?>"/></td>
					</tr>
					<tr>
						<td class="table-head">缩略图</td>
						<td>
						    <label class="control-label" for="bike_type"> </label>
						    <input type="file" style="display:none" name="userfile">
						    <input type="hidden" id="newbikephotoName" name="bike_photo" value="" />
						    <input type="hidden" id="oldbikephotoName" value="" />
						    <div class="controls" style="text-align:center;">
						        <img  id="newbikephoto" src="<?php echo ($article["thumb"]); ?>" style="max-height:600px;max-width:500px;" />
						        <div style="display:block; margin:20px; vertical-align:middle">
						        	<span id="uploadphotoconfirm" class="error_msg" style="margin-bottom:20px;"></span>
							        <input type="button" class="btn btn-primary" id="upload_button" value="上传图片" />
							        <span class="error_msg" style="display:block; margin-top:20px; vertical-align:middle;font-size:14px;">*注意：请上传格式为 png、jpg 或 jpeg 的图片，并且推荐上传小于350*220像素的图片效果最佳</span>
						        </div>
						    </div>
						</td>
					</tr>
					<tr>
						<td class="table-head" >栏目</td>
						<td class="table-content">
							<select class="form-control" name='category'>
								<option value="<?php echo ($article["category"]["cid"]); ?>"><?php echo ($article["category"]["cname"]); ?></option>
								<?php if(is_array($cateList)): foreach($cateList as $key=>$cate): ?><option value="<?php echo ($cate["cid"]); ?>"><?php echo ($cate["cname"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="table-head" >属性</td>
						<td class="table-content">
							<label class="radio-inline">
							  <input type="radio" name="istop" id="inlineRadio1" value="1" check>置顶
							</label>
							<label class="radio-inline">
							  <input type="radio" name="istop" id="inlineRadio2" value="2">不置顶
							</label>
						</td>
					</tr>
					<tr>
						<td class="table-head" >点击次数</td>
						<td class="table-content">
						<input type="number" min="0" max="10000" name="click" id="J_click" class="form-control" value="<?php echo ($article["click"]); ?>"/>
						</td>
					</tr>
					<tr>
						<td class="table-head" >摘要</td>
						<td class="table-content">
						<textarea name="summary" id="J_summary" class="form-control" rows="3" value="<?php echo ($article["summary"]); ?>"></textarea>
						</td>
					</tr>
					<tr>
						<td class="table-head" >内容</td>
						<td class="table-content">
							<textarea name="content" id="J_content" rows="20" value="<?php echo ($article["content"]); ?>"></textarea>
						</td>
					</tr>
					<tr>
						<td class="err_msg_center" id="err_msg" colspan="2" style="text-align:center;"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align:center;">
							<a href="javascript: location.reload();" class="btn btn-primary btn-lg active inline3" role="button">重置</a>
							<a href="javascript:;" id="J_editArt" class="btn btn-primary btn-lg active inline3" role="button">修改</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
	<script>
	  var handleUrl = '<?php echo U( GROUP_NAME .'/Category/edit_handle');?>';
	  var nextUrl = '<?php echo U( GROUP_NAME .'/Category/check');?>';
	</script>
	<script src="__PUBLIC__/js/public.js"></script>	
	<script src="__PUBLIC__/js/article.js"></script>				
</body>
</html>