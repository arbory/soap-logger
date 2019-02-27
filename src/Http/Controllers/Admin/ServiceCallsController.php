<?php

namespace Leonardo\Arbory\Soap\Http\Controllers\Admin;

use Arbory\Base\Admin\Admin;
use Arbory\Base\Admin\Form;
use Arbory\Base\Admin\Form\FieldSet;
use Arbory\Base\Admin\Grid;
use Arbory\Base\Admin\Traits\Crudify;
use Arbory\Base\Html\Html;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Arbory\SoapLogger\Services\ServiceCall;
use Arbory\SoapLogger\Support\XmlFileFormatter;

/**
 * Class ServiceCallsController
 * @package Leonardo\Arbory\Soap\Http\Controllers\Admin
 */
class ServiceCallsController extends Controller
{
    use Crudify;

    /**
     * @var string
     */
    protected $resource = ServiceCall::class;

    /**
     * @var Admin
     */
    protected $admin;

    /**
     * @var Request
     */
    protected $request;

    /**
     * ServiceCallsController constructor.
     * @param Admin $admin
     * @param Request $request
     */
    public function __construct(Admin $admin, Request $request)
    {
        $this->admin = $admin;
        $this->request = $request;
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        $form->setFields(function (FieldSet $fields) {
            $fields->text('environment');
            $fields->text('method');
            $fields->text('path');

            $fields->textarea('request_headers');

            $request = $fields->textarea('request_body');

            $request->setValue(
                XmlFileFormatter::format($request->getValue())
            );

            $fields->textarea('response_headers');

            $response = $fields->textarea('response_body');

            $response->setValue(
                XmlFileFormatter::format($response->getValue())
            );
        });

        return $form;
    }

    /**
     * @param Grid $grid
     */
    public function grid(Grid $grid)
    {
        $grid->tools(['search']);

        $orderDirection = $this->request->get('_order');

        if (!$orderDirection) {
            /**
             * @var Builder $query
             */
            $query = $grid->getFilter()->getQuery();

            $query->orderByDesc('created_at');
        }

        $displayColumn = $this->displayColumn();

        $grid->column('environment')->display($displayColumn);
        $grid->column('method')->display($displayColumn);
        $grid->column('path')->display($displayColumn);
        $grid->column('status')->display($displayColumn);
        $grid->column('created_at')->sortable()->display($displayColumn);
    }

    /**
     * @return \Closure
     */
    protected function displayColumn(): callable
    {
        return function ($value, Grid\Column $attribute, $model) {
            $link = Html::link($value)->addAttributes([
                'href' => $this->module()->url('edit', [$model->getKey()])
            ]);

            if ($value !== '200' && $attribute->getName() === 'status') {
                $link->addAttributes([
                    'style' => 'color:red;'
                ]);
            }

            return $link;
        };
    }
}
