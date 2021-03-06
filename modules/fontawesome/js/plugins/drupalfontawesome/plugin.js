/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Drupal, drupalSettings, CKEDITOR) {
  'use strict';

  CKEDITOR.plugins.add('drupalfontawesome', {
    icons: 'drupalfontawesome',
    hidpi: true,

    init: function init(editor) {
      editor.addCommand('drupalfontawesome', {
        modes: { wysiwyg: 1 },
        canUndo: true,
        exec: function exec(execEditor) {
          var saveCallback = function saveCallback(returnValues) {
            execEditor.fire('saveSnapshot');

            var selection = execEditor.getSelection();
            var range = selection.getRanges(1)[0];

            var container = new CKEDITOR.dom.element('span', execEditor.document);
            container.addClass('fontawesome-icon-inline');
            var icon = new CKEDITOR.dom.element(returnValues.tag, execEditor.document);
            icon.setAttributes(returnValues.attributes);
            container.append(icon);
            container.appendHtml('&nbsp;');

            range.insertNode(container);
            range.select();

            execEditor.fire('saveSnapshot');

            execEditor.fire('insertedIcon');
          };

          var dialogSettings = {
            title: execEditor.config.drupalFontAwesome_dialogTitleAdd,
            dialogClass: 'fontawesome-icon-dialog'
          };

          Drupal.ckeditor.openDialog(execEditor, Drupal.url('fontawesome/dialog/icon/' + execEditor.config.drupal.format), {}, saveCallback, dialogSettings);
        }
      });

      if (editor.ui.addButton) {
        editor.ui.addButton('DrupalFontAwesome', {
          label: Drupal.t('Font Awesome'),
          command: 'drupalfontawesome'
        });
      }
    }
  });
})(jQuery, Drupal, drupalSettings, CKEDITOR);
