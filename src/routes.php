<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Render index view
    return $this->renderer->render($response, 'index.phtml');
});


$app->post('/chatbot', function (Request $request, Response $response, array $args) {

	$bot_logic = new Botlogic();


	$parsed_body = $request->getParsedBody();

	$action = $bot_logic->find_intent($parsed_body);

	switch ($action) {
		case 'rehome-a-cat':
			$bot_response = $bot_logic->get_all_dogs();
			break;
		case 'rehome-a-dog':
			$bot_response = $bot_logic->get_all_cats();
			break;
		default:
			$bot_response = $bot_logic->format_reponse(
				'Not sure what you mean',
				'Not sure what you mean'
			);
			break;
	}

    // Render index view
    return $response->withJson($bot_response);
});
