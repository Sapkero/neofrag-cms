<div role="tabpanel">
	<a id="link-delete" class="btn btn-danger pull-right" href="#" data-toggle="popover" title="<?php echo i18n('remove_link'); ?>" data-content="<?php echo i18n('move_here_to_remove'); ?>" data-placement="top"><?php echo icon('fa-trash-o').i18n('remove'); ?></a>
	<ul id="navigation-tabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#links" aria-controls="links" role="tab" data-toggle="tab"><?php echo i18n('links'); ?></a></li>
		<li role="presentation"><a href="#add-link" aria-controls="add-link" role="tab" data-toggle="tab"><?php echo icon('fa-plus').' '.i18n('add'); ?></a></li>
		<li role="presentation"><a href="#navigation-options" aria-controls="navigation-options" role="tab" data-toggle="tab"><?php echo icon('fa-cogs').' '.i18n('options'); ?></a></li>
	</ul>
	<div class="tab-content">
		<div id="links" class="tab-pane active" role="tabpanel">
			<ul class="list-group no-margin">
			<?php foreach ($data['links'] as $link): ?>
				<li class="list-group-item">
					<input type="hidden" name="settings[title][]" id="edit-title" value="<?php echo $link['title']; ?>" />
					<input type="hidden" name="settings[url][]" id="edit-url" value="<?php echo $link['url']; ?>" />
					<input type="hidden" name="settings[target][]" id="edit-target" value="<?php echo $link['target']; ?>" />
					<ul class="list-inline no-margin">
						<li><a href="#" class="move-link" data-toggle="tooltip" title="<?php echo i18n('move'); ?>"><?php echo icon('fa-arrows-v'); ?></a></li>
						<li><span data-toggle="tooltip" title="<?php echo $link['url']; ?>"><?php echo icon('fa-link'); ?></span></li>
						<li><?php echo $link['title']; ?></li>
					</ul>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
		<div id="add-link" class="tab-pane" role="tabpanel">
			<div class="form-horizontal">
				<div class="panel-group no-margin" id="accordion">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<a class="type-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#type-module" aria-controls="type-module">
								<?php echo icon('fa-edit'); ?> <b>Lien vers un module</b>
							</a>
						</div>
						<div id="type-module" class="panel-collapse collapse" role="tabpanel">
							<?php
							$modules = array();
	
							foreach ($this->addons->get_modules(TRUE) as $module)
							{
								//TODO
								if (!in_array($module->name, array('access', 'admin', 'addons', 'comments', 'error', 'live_editor', 'pages', 'settings', 'games', 'talks')))
								{
									$modules[$module->name] = $module->get_title();
								}
							}
							
							array_natsort($modules);
							
							$modules = array_merge(array(
								'index' => NeoFrag::loader()->lang('home')
							), $modules);
							?>
							<div class="list-group">
								<?php foreach ($modules as $name => $title): ?>
									<a href="#" class="list-group-item link-item" data-link-title="<?php echo $title; ?>" data-link-url="<?php echo $name; ?>.html"><?php echo $title; ?></a>
								<?php endforeach; ?>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label for="settings-title" class="col-sm-3 control-label"><?php echo i18n('title'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-title" value="" placeholder="<?php echo i18n('title'); ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-url" class="col-sm-3 control-label"><?php echo i18n('path'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-url" value="" placeholder="<?php echo i18n('path'); ?>" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-target" class="col-sm-3 control-label"><?php echo i18n('target'); ?></label>
									<div class="col-sm-5">
										<select class="form-control" id="settings-target">
											<option value="_parent"><?php echo i18n('same_window'); ?></option>
											<option value="_blank"><?php echo i18n('new_window'); ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button class="btn btn-primary"><?php echo i18n('add'); ?></button>
										<a class="btn btn-default cancel-link"><?php echo icon('fa-close').' '.i18n('cancel'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$pages = $this->db	->select('p.page_id', 'p.name', 'p.published', 'pl.title', 'pl.subtitle')
									->from('nf_pages p')
									->join('nf_pages_lang pl', 'p.page_id = pl.page_id')
									->where('p.published', TRUE)
									->where('pl.lang', $this->config->lang)
									->order_by('pl.title ASC')
									->get();
									
					if ($pages): ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<a class="type-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#type-page" aria-controls="type-page">
								<?php echo icon('fa-file-text-o'); ?> <b>Lien vers une page</b>
							</a>
						</div>
						<div id="type-page" class="panel-collapse collapse" role="tabpanel">
							<div class="list-group">
								<?php foreach ($pages as $page): ?>
									<a href="#" class="list-group-item link-item" data-link-title="<?php echo $page['title']; ?>" data-link-url="<?php echo $page['name']; ?>.html"><?php echo $page['title']; ?></a>
								<?php endforeach; ?>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label for="settings-title" class="col-sm-3 control-label"><?php echo i18n('title'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-title" value="" placeholder="<?php echo i18n('title'); ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-url" class="col-sm-3 control-label"><?php echo i18n('path'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-url" value="" placeholder="<?php echo i18n('path'); ?>" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-target" class="col-sm-3 control-label"><?php echo i18n('target'); ?></label>
									<div class="col-sm-5">
										<select class="form-control" id="settings-target">
											<option value="_parent"><?php echo i18n('same_window'); ?></option>
											<option value="_blank"><?php echo i18n('new_window'); ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button class="btn btn-primary"><?php echo i18n('add'); ?></button>
										<a class="btn btn-default cancel-link"><?php echo icon('fa-close').' '.i18n('cancel'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<a class="type-collapse link-item" role="button" data-link-title="" data-link-url="" data-toggle="collapse" data-parent="#accordion" href="#type-custom" aria-controls="type-custom">
								<?php echo icon('fa-link'); ?> <b>Lien personnalisé</b>
							</a>
						</div>
						<div id="type-custom" class="panel-collapse collapse" role="tabpanel">
							<div class="panel-body">
								<div class="form-group">
									<label for="settings-title" class="col-sm-3 control-label"><?php echo i18n('title'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-title" value="" placeholder="<?php echo i18n('title'); ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-url" class="col-sm-3 control-label"><?php echo i18n('path'); ?></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="settings-url" value="" placeholder="http://..." />
									</div>
								</div>
								<div class="form-group">
									<label for="settings-target" class="col-sm-3 control-label"><?php echo i18n('target'); ?></label>
									<div class="col-sm-5">
										<select class="form-control" id="settings-target">
											<option value="_parent"><?php echo i18n('same_window'); ?></option>
											<option value="_blank"><?php echo i18n('new_window'); ?></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-5">
										<button class="btn btn-primary"><?php echo i18n('add'); ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div id="navigation-options" class="tab-pane" role="tabpanel">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="settings-title" class="col-sm-3 control-label"><?php echo i18n('orientation'); ?></label>
					<div class="col-sm-5">
						<label class="radio-inline">
							<input type="radio" name="settings[display]" value="0"<?php if ($data['display'] == 0) echo ' checked="checked"'; ?>> <?php echo i18n('vertical'); ?>
						</label>
						<label class="radio-inline">
							<input type="radio" name="settings[display]" value="1"<?php if ($data['display'] == 1) echo ' checked="checked"'; ?>> <?php echo i18n('horizontal'); ?>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#links .list-group').sortable({
			connectWith: '#link-delete',
			cursor: 'move',
			intersect: 'pointer',
			revert: true
		});

		$('#link-delete').droppable({
			accept: '#links .list-group li',
			tolerance: 'pointer',
			drop: function(event, ui){
				ui.draggable.remove();
			}
		});

		var active_id = '';
		$('a.type-collapse').click(function(){
			active_id = $(this).attr('href');

			$('.panel-collapse .panel-body').each(function(){
				$(this).hide();
			});

			$('.form-group').each(function(){
				$(this).removeClass('has-error');
			});

			$(active_id+' .list-group').show();
		});

		$('#add-link .link-item').click(function(){
			$(active_id+' #settings-title').val($(this).data('link-title'));
			$(active_id+' #settings-url').val($(this).data('link-url'));
			$(active_id+' .list-group').hide();
			$(active_id+' .panel-body').show();
		});

		$(document).on('click', '.list-group li a.edit-link', function() {
			var title     = $(this).parent().find('#edit-title').val();
			var url       = $(this).parent().find('#edit-url').val();
			var target    = $(this).parent().find('#edit-target').val();
			
			$('#links .form-edit #settings-title').val(title);
			$('#links .form-edit #settings-url').val(url);
			$('#links .form-edit #settings-target option[value="'+target+'"]').prop('selected', true);

			$('#links .list-group').hide();
			$('#links .form-edit').show();
		});

		$('.cancel-link').click(function(){
			$(active_id+' .panel-body').hide();
			$(active_id+ '.list-group').show();

			active_id = '';
		});

		$('#add-link .btn-primary').click(function(){
			var title  = $(active_id+' #settings-title').val();
			var url    = $(active_id+' #settings-url').val();
			var target = $(active_id+' #settings-target').val();

			if (title && url && target){
				$('#navigation-tabs a:first').tab('show');

				$('<li class="list-group-item">\
						<input type="hidden" name="settings[title][]" id="edit-title" value="'+title+'" />\
						<input type="hidden" name="settings[url][]" id="edit-url" value="'+url+'" />\
						<input type="hidden" name="settings[target][]" id="edit-target" value="'+target+'" />\
						<ul class="list-inline no-margin">\
							<li><a href="#" class="move-link" data-toggle="tooltip" title="<?php echo i18n('move'); ?>"><?php echo icon('fa-arrows-v'); ?></a></li>\
							<li><span data-toggle="tooltip" title="'+url+'"><?php echo icon('fa-link'); ?></span></li>\
							<li>'+title+'</li>\
						</ul>\
					</li>').appendTo('#links .list-group');

				$(active_id+' #settings-title').parents('.form-group:first').removeClass('has-error');
				$(active_id+' #settings-url').parents('.form-group:first').removeClass('has-error');
				$(active_id+' #settings-target').parents('.form-group:first').removeClass('has-error');

				$(active_id+' #settings-title').val('');
				$(active_id+' #settings-url').val('');

				$(active_id+' .panel-body').hide();
				$(active_id+' .list-group').show();
			}
			else {
				if (!title){
					$(active_id+' #settings-title').parents('.form-group:first').addClass('has-error');
				}
				else {
					$(active_id+' #settings-title').parents('.form-group:first').removeClass('has-error');
				}

				if (!url){
					$(active_id+' #settings-url').parents('.form-group:first').addClass('has-error');
				}
				else {
					$(active_id+' #settings-url').parents('.form-group:first').removeClass('has-error');
				}

				if (!target){
					$(active_id+' #settings-target').parents('.form-group:first').addClass('has-error');
				}
				else {
					$(active_id+' #settings-target').parents('.form-group:first').removeClass('has-error');
				}
			}

			return false;
		});
	});
</script>
