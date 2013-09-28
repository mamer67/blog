<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $form CActiveForm */

Yii::app() -> clientScript -> registerScript('script', file_get_contents(dirname(__FILE__) . '/script.js'), CClientScript::POS_BEGIN);
$new = $model -> isNewRecord;
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array('id' => 'form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false, 'htmlOptions' => array('enctype' => 'multipart/form-data'),)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo CHtml::activeTextArea($model,'content',array('rows'=>10, 'cols'=>70)); ?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'tags',
			'url'=>array('suggestTags'),
			'multiple'=>true,
			'htmlOptions'=>array('size'=>50),
		)); ?>
		<p class="hint">Please separate different tags with commas.</p>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
	<?php
       /*$this->widget('ext.EAjaxUpload.EAjaxUpload',
		 array(
			   'id'=>'uploadFile',
			   'config'=>array(
							   'action'=>Yii::app()->createUrl('post/uploadz'),
							   'allowedExtensions'=>array("zip"),//array("jpg","jpeg","gif","exe","mov" and etc...
							   'sizeLimit'=>10*1024*1024,// maximum file size in bytes
							   //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
							   //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",
							   //'messages'=>array(
							   //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
							   //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
							   //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
							   //                  'emptyError'=>"{file} is empty, please select files again without it.",
							   //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
							   //                 ),
							   //'showMessage'=>"js:function(message){ alert(message); }"
							  )
			  ));
		
		echo CHtml::button('upload', array('onclick'=>'send()',));*/
		?>
	</div>
	
	
	<input type="file" id="wupload" name="datafile" onChange = "fileUpload(this.form,'upload','upload'); return false;" required></br>
	<!-- input type="button" value="upload" onClick="fileUpload(this.form,'upload','upload'); return false;" -->
	<div id="upload"></div>
	

	<div class="row buttons">
		<?php 
		//echo CHtml::button('upload', array('onclick'=>'send()',));
		echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
		//echo CHtml::button('Create',array('submit'=>array('create')));
		?>
	</div>

<?php $this->endWidget(); ?>



</div><!-- form -->