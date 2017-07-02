<?php
class RoboFile {
  use \Gbo\Robo\Task\Github\DeployTask;
  use \Robo\Common\ConfigAwareTrait;
    public function createDeploy($token, $org, $repo, $ref, $environment) {

        /**
         * Your CI environment is probably setting environment variables.
         * You could also load those settings from a config adapter.
         *
         * @param $environment
         */
        protected function doDeploy($environment) {
        $this->createDeploy(
            getenv('SECRET_TOKEN'),
            getenv('CI_ORG'),
            getenv('CI_REPO'),
            getenv('CI_REF'),
            getenv('CI_ENVIRONMENT')
        );
    }
}