<?php

namespace App\Http\Controllers;

use App\ChartHelpers\BuildsCharts;
use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\WidgetQuery;
use App\Queries\GridQueries\MarketingImageQuery;
use App\Queries\GridQueries\GadgetQuery;

class ApiController extends Controller
{

    // Begin Gadget Api Data Grid Method

    public function gadgetData(Request $request)
    {
        return GridQuery::sendData($request, new GadgetQuery);
    }

    // End Gadget Api Data Grid Method



    public function widgetData(Request $request)
    {

        return GridQuery::sendData($request, new WidgetQuery);
    }

    public function marketingImageData(Request $request)
    {

        return GridQuery::sendData($request, new MarketingImageQuery);
    }

    public function userChartData(Request $request, BuildsCharts $chart)
    {

        return $chart->buildChart($request, ['users', 'widgets', 'gadgets']);



    }

}
