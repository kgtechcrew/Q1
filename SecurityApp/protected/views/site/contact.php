<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$this->pageTitle   = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<h1>Contact Us</h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="form">

        <?php
        $validate = 0;
        $form     = $this->beginWidget('CActiveForm', array(
            'id'                     => 'contact-form',
            'enableClientValidation' => false,
            'htmlOptions'            => array('onsubmit' => 'return postApi();'),
            'clientOptions'          => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php
        if ($model->hasErrors())
        {
            $validate = 1;
            ?>
            <?php echo $form->errorSummary($model); ?>
            <?php
        }
        ?>
        <?php echo CHtml::hiddenField('_validate', $validate, array('id' => '_validate')); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 60)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('size' => 60)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'subject'); ?>
            <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'subject'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'body'); ?>
            <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 63)); ?>
            <?php echo $form->error($model, 'body'); ?>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Please enter the letters as they are shown in the image above.
                    <br/>Letters are not case-sensitive.</div>
                <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
        <?php endif; ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Submit', array('id' => 'submit')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>

<script type="text/javascript">

    function postApi()
    {
        if ($('#ContactForm_verifyCode').val() != "")
        {
            var data = JSON.stringify({
                "name": document.getElementById("ContactForm_name").value,
                "subject": document.getElementById("ContactForm_subject").value,
                "message": document.getElementById("ContactForm_body").value
            });

            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === 4) {
                    console.log(this.responseText);
					alert("Successfully data posted to API");
                }
            });

            xhr.open("POST", "http://localhost:3000/contact/create");
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Authorization", "Basic YWRtaW46YWRtaW4=");
            xhr.send(data);
        }
    }
</script>
