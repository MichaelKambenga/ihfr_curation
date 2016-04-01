<?php if ($model->request_type == ChangeRequest::TYPE_CREATE): ?>

    <?php $fieldsArray = $model->retrieveNewSiteFields();
    ?>
    <table>
        <?php foreach ($fieldsArray as $key => $field): ?>
            <tr>
                <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>
                <td><?php echo TbHtml::labelTb($field); ?></td>
            </tr>


        <?php endforeach; ?>
        <tr>
            <td><?php echo TbHtml::labelTb('Remarks', array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>
            <td>
                <p></p>
                <?php foreach ($model->changeRequestNotes as $note): ?>
                    <?php
                    echo TbHtml::quote(TbHtml::labelTb($note->sanitize()), array(
                        'source' => User::getUserSignature($note->user_id),
                        'cite' => '',
                        'pull' => TbHtml::PULL_LEFT,
                            )
                    )
                    ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr >
            <td></td>
            <td>
                <?php
                echo TbHtml::button('Reject creation', array(
                    'class' => 'btn btn-default',
                    'onclick' => '$("' . '#reject-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>
                <span>&nbsp;&nbsp;</span>

                <?php
                echo TbHtml::button('Approve creation', array(
                    'class' => 'btn btn-info',
                    'onclick' => '$("' . '#approve-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>               
            </td>
        </tr>
    </table>
    <br />


    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'reject-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Reject Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'reject', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'approve-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Approve Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'approve', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

<?php elseif ($model->request_type == ChangeRequest::TYPE_UPDATE): ?>
    <?php
    $fromToFieldsArray = $model->retrieveFieldsChanges();
    ?>

    <table>
        <?php foreach ($fromToFieldsArray as $key => $fromToArray): ?>

            <tr>
                <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>

                <td>
                    <?php echo TbHtml::labelTb($fromToArray['pub'], array('color' => TbHtml::LABEL_COLOR_INFO)); ?>
                    <?php echo TbHtml::icon(TbHtml::ICON_ARROW_RIGHT) ?>
                    <?php echo TbHtml::labelTb($fromToArray['cur']); ?>
                </td>
            </tr>


        <?php endforeach; ?>
        <tr>
            <td><?php echo TbHtml::labelTb('Remarks', array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>
            <td>
                <p></p>
                <?php foreach ($model->changeRequestNotes as $note): ?>
                    <?php
                    echo TbHtml::quote(TbHtml::labelTb($note->note), array(
                        'source' => User::getUserSignature($note->user_id),
                        'cite' => '',
                        'pull' => TbHtml::PULL_LEFT
                    ))
                    ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr >
            <td></td>
            <td>
                <?php
                echo TbHtml::button('Reject update', array(
                    'class' => 'btn btn-default',
                    'onclick' => '$("' . '#reject-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>
                <span>&nbsp;&nbsp;</span>

                <?php
                echo TbHtml::button('Approve update', array(
                    'class' => 'btn btn-info',
                    'onclick' => '$("' . '#approve-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>
            </td>
        </tr>
    </table>
    <br />

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'reject-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Reject Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'reject', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'approve-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Approve Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'approve', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

<?php elseif ($model->request_type == ChangeRequest::TYPE_DELETE): ?>
    <?php
    $fieldsArray = $model->retrieveNewSiteFields();
    ?>
    <table>
        <?php foreach ($fieldsArray as $key => $field): ?>

            <tr>
                <td><?php echo TbHtml::labelTb($key, array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>
                <td><?php echo TbHtml::labelTb($field); ?></td>
            </tr>


        <?php endforeach; ?>
        <tr>
            <td><?php echo TbHtml::labelTb('Remarks', array('color' => TbHtml::LABEL_COLOR_INFO)) ?></td>
            <td>
                <p></p>
                <?php foreach ($model->changeRequestNotes as $note): ?>
                    <?php
                    echo TbHtml::quote(TbHtml::labelTb($note->note), array(
                        'source' => User::getUserSignature($note->user_id),
                        'cite' => '',
                        'pull' => TbHtml::PULL_LEFT
                    ))
                    ?>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr >
            <td></td>
            <td>
                <?php
                echo TbHtml::button('Reject deletion', array(
                    'class' => 'btn btn-default',
                    'onclick' => '$("' . '#reject-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>
                <span>&nbsp;&nbsp;</span>

                <?php
                echo TbHtml::button('Approve deletion', array(
                    'class' => 'btn btn-info',
                    'onclick' => '$("' . '#approve-dialog' . $model->id . '").dialog("open");return false;',
                        )
                )
                ?>
            </td>
        </tr>
    </table>
    <br />


    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'reject-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Reject Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'reject', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'approve-dialog' . $model->id,
        // additional javascript options for the dialog plugin
        'options' => array(
            'title' => 'Approve Request',
            'autoOpen' => false,
            'height' => 300,
            'width' => 400,
        ),
    ));

    $this->renderPartial('//changeRequestNote/_form', array('model' => new ChangeRequestNote, 'actionType' => 'approve', 'id' => $model->id));

    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
<?php endif; ?>