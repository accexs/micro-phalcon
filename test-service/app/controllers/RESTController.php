<?php
namespace App\Controllers;

use App\Exceptions\AbstractHttpException;

/**
 * Base RESTful Controller.
 * Supports queries with the following paramters:
 *   Limits:
 *     limit=10
 *   Partials:
 *     offset=20
 *
 */
class RESTController extends \App\Controllers\BaseController
{
    /**
     * Set when there is a 'limit' query parameter
     * @var integer
     */
    protected $limit = null;

    /**
     * Set when there is an 'offset' query parameter
     * @var integer
     */
    protected $offset = null;

    /**
     * Constructor, calls the parse method for the query string by default.
     * @param boolean $parseQueryString true Can be set to false if a controller needs to be called
     *        from a different controller, bypassing the $allowedFields parse
     * @return void
     */
    public function __construct($parseQueryString = true)
    {
        parent::__construct();
        if ($parseQueryString) {
            $this->parseRequest();
        }

        return;
    }

    /**
     * Main method for parsing a query string.
     * mainly takes limit and offset for pagination
     *
     * @return boolean              Always true if no exception is thrown
     */
    protected function parseRequest()
    {
        $request = $this->di->get('request');
        $searchParams = $request->get('q', null, null);
        $fields = $request->get('fields', null, null);

        // Set limits and offset, elsewise allow them to have defaults set in the Controller
        $this->limit = (int)($request->get('limit', null, null)) ?: (int)$this->limit;
        $this->offset = (int)($request->get('offset', null, null)) ?: (int)$this->offset;

        $this->optionsBase();

        return true;
    }

    /**
     * Provides a base CORS policy for routes like '/users' that represent a Resource's base url
     * Origin is allowed from all urls.
     *
     * @return true
     */
    public function optionsBase()
    {
        $response = $this->di->get('response');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, PUT, PATCH, DELETE, OPTIONS, HEAD');
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Credentials', 'true');
        $response->setHeader('Access-Control-Allow-Headers', "origin, x-requested-with, content-type");
        $response->setHeader('Access-Control-Max-Age', '86400');
        return true;
    }
}
