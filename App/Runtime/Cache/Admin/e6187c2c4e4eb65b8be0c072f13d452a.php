<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>	
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap.3.3.5.min.css"/>
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap-theme.3.3.5.min.css"/>
	<link rel="stylesheet" href="__PUBLIC__/css/font-awesome.min.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/main_table.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="__PUBLIC__/css/user-manage.css" />
	<script src="__PUBLIC__/js/jquery.js"></script>
	<script src="__PUBLIC__/js/bootstrap.3.3.5.min.js"></script>
	<script src="__PUBLIC__/js/bootstrap-datetimepicker.min.js"></script>
	<script src="__PUBLIC__/js/bootstrap-datetimepicker.zh-CN.js"></script>
	<script src="__PUBLIC__/js/public.js"></script>
	<script src="__PUBLIC__/js/pccs.js"></script>
    <script src="__PUBLIC__/js/ajaxupload.3.6.js"></script>
    <script type="text/javascript">
	    $(function(){
	    	//图片上传处理
		    var button = $('#upload_button'), interval;
		    var confirmdiv = $('#uploadphotoconfirm');
		    var fileType = "pic",fileNum = "one"; 
		    new AjaxUpload(button,{
		        action: "<?php echo U(GROUP_NAME . '/Admin/uppic');?>",
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
		                         $("#newbikephotoName").val("__ROOT__/Uploads/images/"+response);
		                         $("#newbikephoto").attr("src","__ROOT__/Uploads/images/"+response);            
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
</head>
<body>
	<form>
		<div class="table-section">
			<p><span class="icon-user">&nbsp</span>基本资料</p>
			<table class="mc-table mc-table-striped mc-table-hover mc-table-prev">
		 		<tbody>
					<tr>
						<td class="td_head">昵称：</td>
						<td>
							<input type="text" class="form-control" id="J_username" name="username" placeholder="管理员用户名">
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">头像：</td>
						<td>
						    <label class="control-label" for="bike_type"> </label>
						    <input type="file" style="display:none" name="userfile">
						    <input type="hidden" id="newbikephotoName" name="bike_photo" value="" />
						    <input type="hidden" id="oldbikephotoName" value="" />
						    <div class="controls" style="text-align:center;">
						        <img  id="newbikephoto" src="__PUBLIC__/images/nophoto.jpg" style="max-height:140px;max-width:100px;" />
						        <span style="display:inline-block; margin-top:10px; vertical-align:middle">
							        <input type="button" class="btn btn-primary" id="upload_button" value="上传图片" />
							        <span class="error_msg" style="display:block; margin-top:10px; vertical-align:middle;font-size:14px;">*请上传格式为 png、jpg 或 jpeg 的图片,分辨率建议为150*210px</span>
						        </span>
						    </div>
						</td>
						<td class="limit">
							<span id="uploadphotoconfirm" class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">性别：</td>
						<td>
							<select class="form-control" id="J_sex">
							  <option value="0">男</option>
							  <option value="1">女</option>
							</select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">生日：</td>
						<td>
							<input id="J_birthday" class="form-control form_datetime" type="text" name="birthday" value="1970-01-01" readonly >
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">星座：</td>
						<td>
							<select class="form-control" id="J_constellation" name="constellation">
								<option value="水瓶座">水瓶座</option>
								<option value="双鱼座">双鱼座</option>
								<option value="白羊座">白羊座</option>
								<option value="金牛座">金牛座</option>
								<option value="双子座">双子座</option>
								<option value="巨蟹座">巨蟹座</option>
								<option value="狮子座">狮子座</option>
								<option value="处女座">处女座</option>
								<option value="天秤座">天秤座</option>
								<option value="天蝎座">天蝎座</option>
								<option value="射手座">射手座</option>
								<option value="摩羯座">摩羯座</option>
							</select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">生肖：</td>
						<td>
							<select class="form-control" id="J_animalsign" name="animalsign">
								<option value="鼠">鼠</option>
								<option value="牛">牛</option>
								<option value="虎">虎</option>
								<option value="兔">兔</option>
								<option value="龙">龙</option>
								<option value="蛇">蛇</option>
								<option value="马">马</option>
								<option value="羊">羊</option>
								<option value="猴">猴</option>
								<option value="鸡">鸡</option>
								<option value="狗">狗</option>
								<option value="猪">猪</option>
							</select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">故乡：</td>
						<td>
							<select name="home_province" id="province">
				            </select>
					            <select name="home_city" id="city">
					            </select>
					                <select name="home_county" id="county">
					                </select>
                		</td>
                		<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">主页名：</td>
						<td>
							<input type="text" class="form-control" id="J_indexname" name="indexname" placeholder="主页名">
						</td>
						<td class="limit">
							<span class="error_msg">*不超过6个汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">座右铭：</td>
						<td><textarea name="motto" id="J_motto"class="form-control" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过60个汉字</span>
						</td>
					</tr>

					<tr>
						<td class="td_head">现居地址：</td>
						<td>
						<select name="current_province" id="province1">
				            </select>
					            <select name="current_city" id="city1">
					            </select>
					                <select name="current_county" id="county1">
					                </select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">自我介绍：</td>
						<td><textarea class="form-control" name="introduce" id="J_introduce" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">近期梦想：</td>
						<td><textarea class="form-control" name="dream" id="J_dream" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="table-section">
			<p><span class="span_people">&nbsp</span>个人信息</p>
			<table class="mc-table mc-table-striped mc-table-hover mc-table-prev">
		 		<tbody>
					<tr>
						<td class="td_head">学位：</td>
						<td>
							<select class="form-control" name="degree" id="J_degree" >
							  <option value="博士">博士</option>
							  <option value="硕士">硕士</option>
							  <option value="本科">本科</option>
							  <option value="高中">高中</option>
							  <option value="初中">初中</option>
							  <option value="小学">小学</option>
							</select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">职业：</td>
						<td><input type="text" class="form-control" id="J_career" name="career" placeholder="职业"></td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">婚姻状况：</td>
						<td>
							<select class="form-control" name="ismarried" id="J_ismarried">
							  <option value="0">未婚</option>
							  <option value="1">已婚</option>
							</select>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">专业特长：</td>
						<td><textarea class="form-control" name="majortag" id="J_majortag" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*各标签用“,”隔开</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">兴趣爱好：</td>
						<td><textarea class="form-control" name="like" id="J_like" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">喜欢的运动：</td>
						<td><textarea class="form-control" name="sports" id="J_sports" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">喜欢的音乐：</td>
						<td><textarea class="form-control" name="musics" id="J_musics" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">喜欢的电影：</td>
						<td><textarea class="form-control" name="films" id="J_films" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">喜欢的书籍：</td>
						<td><textarea class="form-control" name="books" id="J_books" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
					<tr>
						<td class="td_head">喜欢的明星：</td>
						<td><textarea class="form-control" name="superstars" id="J_superstars" rows="3"></textarea></td>
						<td class="limit">
							<span class="error_msg">*不超过255个UTF-8格式的汉字</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="table-section">
			<p><span class="span_people">&nbsp</span>个人学历</p>
			<table class="mc-table mc-table-striped mc-table-hover mc-table-prev">
		 		<tbody>
		 			<!-- 经历一 -->
					<tr>
						<td class="td_head"  colspan="3">本科：</td>
					</tr>
					<tr>
						<td class="td_head">内容：</td>
						<td>
							<textarea class="form-control" name="college_life" id="J_college_life" rows="3"></textarea>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<!-- 经历二 -->
					<tr>
						<td class="td_head"  colspan="3"></td>
					</tr>
					<tr>
						<td class="td_head"  colspan="3">高中：</td>
					</tr>
					<tr>
						<td class="td_head">内容：</td>
						<td>
							<textarea class="form-control" name="senior_life" id="J_senior_life" rows="3"></textarea>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
			    	<!-- 经历三 -->
					<tr>
						<td class="td_head"  colspan="3"></td>
					</tr>
					<tr>
						<td class="td_head"  colspan="3">初中：</td>
					</tr>
					<tr>
						<td class="td_head">内容：</td>
						<td>
							<textarea class="form-control" name="middle_life" id="J_middle_life" rows="3"></textarea>
						</td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
			
				</tbody>
			</table>
		</div>
		<div class="table-section">
			<p><span class="span_people">&nbsp</span>联系方式</p>
			<table class="mc-table mc-table-striped mc-table-hover mc-table-prev">
		 		<tbody>
					<tr>
						<td class="td_head">QQ：</td>
						<td><input type="text" class="form-control" id="J_qq" name="qq"></td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">E-Mail：</td>
						<td><input type="text" class="form-control" id="J_email" name="email"></td>
						<td class="limit">
							<span class="error_msg" id="email_error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">手机号码：</td>
						<td><input type="text" class="form-control" id="J_mobile" name="mobile"></td>
						<td class="limit">
							<span class="error_msg" id="mobile_error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">固定电话：</td>
						<td><input type="text" class="form-control" id="J_telephone" name="telephone"></td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">联系地址：</td>
						<td><input type="text" class="form-control" id="J_contactaddress" name="contactaddress"></td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td class="td_head">邮政编码：</td>
						<td><span><input type="text" class="form-control" id="J_zipcode" name="zipcode"></span></td>
						<td class="limit">
							<span class="error_msg"></span>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<span class="error_msg"  id="J_error_msg"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<a href="javaScript:;" id="J_post" class="btn btn-primary btn-lg active post-btn" role="button">提交</a>
		</div>
	</form>
	 <script>
	    //省市县联动下拉单选框
        setup();
        setup1();

        //日期选择
	    $(".form_datetime").datetimepicker({
	    	language: 'zh-CN',/*加载日历语言包，可自定义*/
	        format: "yyyy-mm-dd",
	        startDate: "1970-01-01",
	        todayBtn: true,
         	autoclose: true
	    });

	    var handleUrl = '<?php echo U(GROUP_NAME . "/Admin/info_handle");?>/'; 
    </script>
	<script src="__PUBLIC__/js/admin.js"></script>
</body>
</html>