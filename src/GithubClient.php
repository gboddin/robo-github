<?php
namespace Gbo\Robo\Task\Github {

    trait GithubClient {

        /**
         * Gets a github client
         * @param $token HTTP github auth token
         * @return \Github\Client
         */
        protected function getGithubClient($token) {
            $client = new \Github\Client();
            $apiKey = $token;
            if($apiKey) {
                $client->authenticate($apiKey,null,\Github\Client::AUTH_HTTP_TOKEN);
            }
            return $client;
        }
    }
}