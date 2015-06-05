/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
$.widget( 'xidea.formcollection', {
    options: {
        prototype: '',
        addButton: '<a href="#">Dodaj</a>',
        removeButton: '<a href="#">Usuń</a>',
        formTag: 'div'
    },
    _create: function() {
        this.index = this.element.find(this.options.formTag).length;
        this.element.find(this.options.formTag).each(function() {
           this._createRemoveButton($(this)); 
        });
        this._createAddButton();
    },
    _createAddButton: function() {
        var $addButton = $(this.options.addButton);
        this.element.append($(document.createElement(this.options.formTag)).append($addButton));
        
        $addButton.on('click', function(e) {
            e.preventDefault();
            this.addForm($addButton);
        });
    },
    _createRemoveButton: function($container) {
        var $removeButton = $(this.options.removeButton);
        $container.append($removeButton);

        var $widget = this;
        $removeButton.on('click', function(e) {
            e.preventDefault();
            $container.remove();
            $widget.index -= 1;
        });
    },
    _addForm: function($addButton) {
        var form = this.options.prototype.replace('__name__/g', this.index);
        this.index += 1;
        
        var $form = $(this.options.formContainer).append(form);
        $addButton.before($form);
        this._createRemoveButton($form);
    }
});


