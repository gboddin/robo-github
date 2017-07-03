<?php
namespace Gbo\Robo\Task\Github {

    trait DeployTask {
        use GithubClient;

        /**
         * Create a github deployment
         *
         * @command github:deploy:create
         * @parma  string $token Github http auth token
         * @param  string $org   Organisation name
         * @param  string $repo Repository name
         * @param  string $ref  Git reference
         * @param  string $environment Environment to deploy to
         */
        public function createDeploy($token, $org, $repo, $ref, $environment) {
            $this->getGithubClient($token)->api('deployment')->create(
                $org,
                $repo,
                array('required_contexts' => [],
                    'auto_merge' => false,
                    'environment' => $environment,
                    'ref' => $ref)
            );
        }

        /**
         * Finish a github deployment
         *
         * @command github:deploy:finish
         * @parma  string $token Github http auth token
         * @param  string $org   Organisation name
         * @param  string $repo Repository name
         * @param  string $ref  Git reference
         * @param  string $environment Environment to mark as deployed
         */
        public function finishDeploy($token, $org, $repo, $ref, $environment) {
            $this->updateDeploy($token, $org, $repo, $ref, $environment, 'success');
        }

        /**
         * Fail a github deployment
         *
         * @command github:deploy:fail
         * @parma  string $token Github http auth token
         * @param  string $org   Organisation name
         * @param  string $repo Repository name
         * @param  string $ref  Git reference
         * @param  string $environment Environment to mark as failed
         */
        public function failDeploy($token, $org, $repo, $ref, $environment) {
            $this->updateDeploy($token, $org, $repo, $ref, $environment, 'error');
        }

        /**
         * Update a github deployment
         *
         * @parma  string $token Github http auth token
         * @param  string $org   Organisation name
         * @param  string $repo Repository name
         * @param  string $ref  Git reference
         * @param  string $environment Environment to update
         * @param  string $status "success","error", refer to Github API
         */
        protected function updateDeploy($token, $org, $repo, $ref, $environment, $status) {
            foreach($this->getGithubClient($token)->api('deployment')
                        ->all($org, $repo,
                            array( 'environment' => $environment,
                                'sha' => $ref)) as $deployment) {
                $this->getGithubClient($token)->api('deployment')->updateStatus(
                    $org,
                    $repo,
                    $deployment['id'],
                    array('state' => $status));
            }
        }
    }
}