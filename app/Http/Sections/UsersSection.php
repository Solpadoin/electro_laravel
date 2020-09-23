<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\SaveAndCreate;
use SleepingOwl\Admin\Section;

/**
 * Class UsersSection
 *
 * @property \App\Models\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class UsersSection extends Section implements Initializable
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    /**
     * Initialize class.
     */
    public function initialize()
    {
        $this->addToNavigation()->setPriority(100)->setIcon('fa fa-users');
    }

    /**
     * @param array $payload
     *
     * @return DisplayInterface
     */
    public function onDisplay($payload = [])
    {
        $columns = [
            AdminColumn::text('id', '#')->setWidth('20px')->setHtmlAttribute('class', 'text-center')->setOrderable(
                function($query, $direction) {
                    $query->orderBy('id', $direction);
                }
            )
                ->setSearchable(true)
            ,
            AdminColumn::link('name', 'Name')->setWidth('120px')
                ->setSearchCallback(function($column, $query, $search){
                    return $query
                        ->orWhere('name', 'like', '%'.$search.'%')
                    ;
                })
                ->setSearchable(true)
            ,
            AdminColumn::boolean('is_admin', 'Admin')->setWidth('100px'),
            AdminColumn::text('role', 'User Role')
                ->setWidth('128px')
                ->setSearchable(true) // search by the role
            ,
            //AdminColumn::boolean('name', 'On'),
            AdminColumn::text('created_at', 'Created / updated', 'updated_at')
                ->setWidth('80px')
                ->setSearchable(false)
            ,
        ];

        $display = AdminDisplay::datatables()
            ->setName('firstdatatables')
            ->setOrder([[0, 'asc']])
            ->setDisplaySearch(true)
            ->paginate(5)
            ->setColumns($columns)
            ->setHtmlAttribute('class', 'table-primary table-hover th-center')
        ;

        /*
        $display->setColumnFilters([
            AdminColumnFilter::select()
                ->setModelForOptions(\App\Models\User::class, 'name')
                ->setLoadOptionsQueryPreparer(function($element, $query) {
                    return $query;
                })
                ->setDisplay('name')
                ->setColumnName('name')
                ->setPlaceholder('All names')
            ,
        ]);

        $display->getColumnFilters()->setPlacement('card.heading');
        */

        return $display;
    }

    /**
     * @param int|null $id
     * @param array $payload
     *
     * @return FormInterface
     */
    public function onEdit($id = null, $payload = [])
    {
        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('id', 'User ID')->setReadonly(true),
                AdminFormElement::text('name', 'Name')
                    ->required()
                ,
                AdminFormElement::text('email', 'User E-mail')
                    ->required()
                ,
                AdminFormElement::text('role', 'User Role')
                    ->required()
                ,
                AdminFormElement::checkbox('is_admin', 'Is Admin')
                ,
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-3')->addColumn([
                //AdminFormElement::html('last AdminFormElement without comma'),
                AdminFormElement::datetime('created_at', 'Created at')
                    ->setVisible(true)
                    ->setReadonly(true)
                ,
                AdminFormElement::datetime('updated_at', 'Updated at')
                    ->setVisible(true)
                    ->setReadonly(true)
                ,
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-3'),
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'save_and_create'  => new SaveAndCreate(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return FormInterface
     */
    public function onCreate($payload = [])
    {
        $form = AdminForm::card()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('id', 'User ID')->setReadonly(true),
                AdminFormElement::text('name', 'Name')
                    ->required()
                ,
                AdminFormElement::text('email', 'User E-mail')
                    ->required()
                ,
                AdminFormElement::text('password', 'User password')
                    ->required()
                ,
                AdminFormElement::text('role', 'User Role')
                    ->required()
                ,
                AdminFormElement::checkbox('is_admin', 'Is Admin')
                ,
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-3')->addColumn([
                //AdminFormElement::html('last AdminFormElement without comma'),
                AdminFormElement::datetime('created_at', 'Created at')
                    ->setVisible(true)
                    ->setReadonly(true)
                ,
                AdminFormElement::datetime('updated_at', 'Updated at')
                    ->setVisible(true)
                    ->setReadonly(true)
                ,
            ], 'col-xs-12 col-sm-6 col-md-4 col-lg-3'),
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'save_and_create'  => new SaveAndCreate(),
            'cancel'  => (new Cancel()),
        ]);

        return $form;
    }

    /**
     * @return bool
     */
    public function isDeletable(Model $model)
    {
        return true;
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // remove if unused
    }
}
