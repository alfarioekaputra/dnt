<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('barangRampasan/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('barangRampasan/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'barangRampasan/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <div class="span11">
		<div class="row">
			<div class="form-inline">
				<label><div class="span1">Jenis</div> <?php echo $form['nama']->render() ?></label>
			</div>
			<div class="form-inline">
				<label><div class="span1">Jumlah</div> <?php echo $form['jumlah']->render() ?></label>
				<label><div class="span1">Satuan</div> <?php echo $form['id_satuan']->render() ?></label>
			</div>
			</div>
		</div>
	  </div>
    </tbody>
  </table>
</form>
