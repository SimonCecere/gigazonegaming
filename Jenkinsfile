#!/usr/bin/env groovy
retry(2) {

    node {

        currentBuild.result = "SUCCESS"

        try {

            /**
             * Check out project from source control
             */
            stage('Info') {

                echo "\u2605 BUILD_URL=${env.BUILD_URL} \u2605"
                echo "\u2605 WORKSPACE=${env.WORKSPACE} \u2605"

            }

            /**
             * Check out project from source control
             */
            stage('Checkout') {

                def scm_url = 'https://github.com/paulbunyannet/gigazonegaming.git'
                echo "\u2605 Checking out project from ${scm_url} \u2605"
                checkout([$class: 'GitSCM', branches: [[name: '*/develop']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: 'a90cc198-6371-4211-8f0e-4344197a9fc1', url: "${scm_url}"]]])

            }

            /**
             * Create the decrypt password file to decrypt encoded files in 'Install Assets' stage
             */
            stage('Decrypt Credential') {

                echo "\u2605 Decrypting credential and config files from repository \u2605"

                withCredentials([string(credentialsId: 'gigazone-gaming-decode-code', variable: 'decrypt_password')]) {
                    writeFile file: '.enc-pass', text: decrypt_password
                }

            }

            /**
             * Fix phing config files
             */
           stage('Fix Phing Config Files') {
                echo "\u2605 Fix phing config files \u2605"

                def build_dir = "${env.WORKSPACE}/build/config"
                List jenkins_phing_configs = ["${build_dir}/jenkins.config", "${build_dir}/hosts/jenkins.host"]
                for (String jenkins_phing_config : jenkins_phing_configs) {
                    sh "sed 's/production/jenkins/' ${jenkins_phing_config} >/dev/null"
                }
           }

            /**
            * Run Cleanup of Vagrant environment
            */
            stage('Vagrant Cleanup') {

                def box_name = 'gigazonegaming.local'
                echo "\u2605 Run Cleanup of Vagrant environment for ${box_name} \u2605"

                sh "VBoxManage controlvm ${box_name} poweroff || echo '${box_name} was not powered off, it might not have existed.'"
                sh "VBoxManage unregistervm ${box_name} --delete || echo '${box_name} was not deleted, it might not have existed.'"
                sh "rm -rf '/var/lib/jenkins/VirtualBox VMs/${box_name}' || echo '/var/lib/jenkins/VirtualBox VMs/${box_name} was not deleted, it might not have existed.'"
                sh "vagrant destroy"
                sh "vagrant box update"


           }

           /**
            * Fix vagrant file config path
            */
           stage('Fix Vagrantfile') {

                echo "\u2605 Fix Vagrantfile so it will use the correct config file \u2605"
                sh "sed 's/config-custom.yaml/config-jenkins.yaml/' ${env.WORKSPACE}/Vagrantfile >/dev/null"

           }

           /**
            * Download tools
            */

           stage('Download Tools') {

                echo "\u2605 Download tools needed for later \u2605"
                parallel (
                    phase1: {
                        // get composer.phar
                        sh "wget -q -N https://getcomposer.org/composer.phar -O ${env.WORKSPACE}/composer.phar"
                    }
                    phase2: {
                        // get c3.phar
                        sh "wget -q -N https://raw.github.com/Codeception/c3/2.0/c3.php -O ${env.WORKSPACE}/c3.php"
                    }
                    phase3: {
                        // get codecept.phar
                        sh "wget -q -N http://codeception.com/codecept.phar -O ${env.WORKSPACE}/codecept.phar"
                    }
                )

           }

           /**
            * Boot Up Vagrant box
            */
           stage('Boot Vagrant Box') {
                echo "\u2605 Booting up Vagrant box \u2605"
                sh "vagrant up"

           }

            /**
             * Check Vagrant status
             */
           stage('Check Vagrant Status') {
                def vagrant_status = sh (
                    script: 'vagrant status',
                    returnStdout: true
                )
                echo "\u2605 Vagrant status: ${vagrant_status} \u2605"
           }


        /**
         * Run third party installers in parallel
         */
         stage('Install 3rd party libraries') {

             parallel (

                /**
                 * Install NPM modules though Yarn
                 */
               phase1: {
                    echo "\u2605 Installing NPM libraries through Yarn \u2605"
                    sh "vagrant ssh -c \"sudo npm install -g yarn; cd /var/www; yarn install\""

               }

                /**
                 * Install Composer modules
                 */
               phase2: {
                    echo "\u2605 Installing Composer dependencies \u2605"
                    sh "vagrant ssh -c \"cd /var/www; php composer.phar install\""
               }

                /**
                 * Install Bower modules
                 */
               phase3: {
                    echo "\u2605 Installing Bower dependencies \u2605"
                    sh "vagrant ssh -c \"sudo npm install -g bower; cd /var/www; bower install\""
               }

                /**
                 * Copying script to required places
                 */
               phase4: {
                    echo "\u2605 Copying script to required places \u2605"
                    sh "vagrant ssh -c \"cd /var/www; npm run-script copy-libraries\""
               }

            )
         }

            /**
             * Compile scripts with Gulp
             */
           stage('Gulp') {
                echo "\u2605 Copying script to required places \u2605"
                sh "vagrant ssh -c \"sudo npm install -g gulp; cd /var/www; gulp\""
           }



           stage('Additonal build prep tasks') {
                parallel (

                    /**
                     * Clean Wordpress wp folder
                     */
                   phase1: {
                        def wp_folder = "${env.WORKSPACE}/public_html/wp"
                        echo "\u2605 Cleaning ${wp_folder} folder \u2605"
                        sh "rm -rf ${wp_folder}/wp-content"
                        sh "rm -f ${wp_folder}/wp-config-sample.php"
                        sh "rm -f ${wp_folder}/.htaccess"

                   }

                    /**
                     * create cache dir if not already existing
                     */
                   phase2: {
                        echo "\u2605 Create cache dir if not already existing \u2605"
                        sh "vagrant ssh -c \"cd /var/www; mkdir -m 0770 cache || echo ''\""
                   }


                    /**
                     * generate new Laravel app key
                     */
                   phase3: {
                        echo "\u2605 Generate new Laravel app key \u2605"
                        sh "vagrant ssh -c \"cd /var/www; php artisan key:generate;\""
                   }

                    /**
                     * generate new Laravel app key
                     */
                   phase4: {
                        echo "\u2605 Generate new Wordpress app keys \u2605"
                        sh "vagrant ssh -c \"cd /var/www; php artisan wp:keys --file=.env;\""
                   }

                    /**
                     * Migrate dbs
                     */
                   phase5: {
                        echo "\u2605 Run DB migrations \u2605"
                        sh "vagrant ssh -c \"cd /var/www; php artisan migrate\""
                   }

                    /**
                     * Preping testing environment
                     */
                   phase5: {
                        echo "\u2605 Prep testing environment \u2605"
                        sh "vagrant ssh -c \"cd /var/www; php codecept.phar clean && php codecept.phar build\" >/dev/null 2>&1"
                   }
                )
            }

            /**
             * Run Assertion Tests
             */

            stage('Assertion Tests') {
                def test_started = sh (
                    script: "date +'%Y-%m-%d %H:%M:%S'",
                    returnStdout: true
                )
                echo "\u2605 Running Assertion Tests, started at ${test_started} \u2605"
                sh 'vagrant ssh -c "cd /var/www; php codecept.phar run acceptance -f -v"'
            }

            /**
             * Run Functional Tests
             */

            stage('Functional Tests') {
                def test_started = sh (
                    script: "date +'%Y-%m-%d %H:%M:%S'",
                    returnStdout: true
                )
                echo "\u2605 Running Functional Tests, started at ${test_started} \u2605"
                sh 'vagrant ssh -c "cd /var/www; php codecept.phar run functional -f -v"'
            }

            /**
             * Run Integration Tests
             */

            stage('Integration Tests') {
                def test_started = sh (
                    script: "date +'%Y-%m-%d %H:%M:%S'",
                    returnStdout: true
                )
                echo "\u2605 Running Integration Tests, started at ${test_started} \u2605"
                sh 'vagrant ssh -c "cd /var/www; php codecept.phar run integration -f -v"'
            }

            /**
             * Run Unit Tests
             */
            stage('Unit Tests') {
                def test_started = sh (
                    script: "date +'%Y-%m-%d %H:%M:%S'",
                    returnStdout: true
                )
                echo "\u2605 Running Unit Tests, started at ${test_started} \u2605"
                sh 'vagrant ssh -c "cd /var/www; php codecept.phar run unit -f -v"'
            }

            /**
             * Build successful, send out an email to the one who prompted the job
             */
            stage('success') {

                wrap([$class: 'BuildUser']) {
                    def email = env.BUILD_USER_EMAIL
                    def first_name = env.BUILD_USER_FIRST_NAME

                    def groovyDomain = fileLoader.fromGit('domain-name-from-url.groovy',
                                                                   'https://github.com/paulbunyannet/groovy-scripts.git', 'master', null, '')

                    def domain = groovyDomain.domainNameFromUrl("${env.JENKINS_URL}")

                    def groovyNiceDuration = fileLoader.fromGit('nice-duration.groovy',
                                               'https://github.com/paulbunyannet/groovy-scripts.git', 'master', null, '')

                    def duration = groovyNiceDuration.niceDuration("${currentBuild.timeInMillis}")

                    mail body: "Hi ${first_name}, The project build was successful for job ${env.JOB_NAME} (build number ${currentBuild.number})! The job took ${duration} to build.",
                                from: "notify@${domain}",
                                replyTo: "notify@${domain}",
                                subject: "Project build successful for job ${env.JOB_NAME}",
                                to: "${email}"
                }

            }

        } catch(Exception e) {
            /**
             * Job failed, send out a message with the failure
             */

            currentBuild.result = "FAILURE"

            def groovyDomain = fileLoader.fromGit('domain-name-from-url.groovy',
                                                                   'https://github.com/paulbunyannet/groovy-scripts.git', 'master', null, '')

            def domain = groovyDomain.domainNameFromUrl("${env.JENKINS_URL}")

            mail body: "Oh no ${env.BUILD_USER_FIRST_NAME}, the project build for ${currentBuild.displayName} (build number ${currentBuild.number}) was unsuccessfull. See the output here: ${currentBuild.absoluteUrl}" ,
                 from: "notify@${domain}",
                 replyTo: "notify@${domain}",
                 subject: "Project build error for ${currentBuild.displayName}",
                 to: "${env.BUILD_USER_EMAIL}"

            throw err
        }
    }
}