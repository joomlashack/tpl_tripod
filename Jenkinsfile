def repo_name = 'tpl_tripod'

def getManifestPath() {
    return 'src/templateDetails.xml'
}

def version(String path) {
    def value = sh(returnStdout: true, script: "sed -n 's:.*<version>\\(.*\\)</version>.*:\\1:p' ${getManifestPath()}")

    return value.trim()
}

def splitVersion(String path) {
    def version = version(path)

    if (version.count(".") == 2) {
        return version.trim().split("\\.")
    }

    return ""
}

def bumpVersion(String path) {
    def version = splitVersion(path)
    def majorVersion = version[0]
    def minorVersion = version[1]
    def patchVersion = version[2].toInteger() + 1
    def newVersion = "${majorVersion}.${minorVersion}.${patchVersion}"

    sh("sed -i \"s|\\(<version>\\)[^<>]*\\(</version>\\)|\\1${newVersion}\\2|\" ${path}")

    return newVersion
}

node {
    stage('fetching') {
        git url: "git@github.com:OSTraining/${repo_name}.git", credentialsId: "ostraining-jenkins-github", branch: 'master'
    }

    stage('updating') {
        sh('git submodule update --init --recursive --remote')
        dir('wright') {
            sh('git checkout master')
            sh('git pull')
        }
    }

    stage('checking and pushing changes') {
        def hasChanged = sh(returnStdout: true, script: 'if git diff-index --quiet HEAD --; then echo 0; else echo 1; fi')

        if (hasChanged.trim().equals('1')) {
            println 'The Wright framework was updated'

            withCredentials([usernamePassword(credentialsId: 'ostraining-jenkins-github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
                // Update the version
                def newVersion = bumpVersion(getManifestPath())

                sh("git commit -am \"Update Wright framework and bump the patch version to ${newVersion}\"")
                sh('git push --set-upstream origin master')
                sh("git tag -a \"v${newVersion}\" -m \"Releasing v${newVersion} after updating Wright framework.\"")
                sh("git push origin \"v${newVersion}\"")
                // Create the release
                sh("source ~/.bashrc && /var/lib/jenkins/go/bin/github-release release --user ostraining --repo ${repo_name} --tag v${newVersion} --name \"v${newVersion} - Maintenance Release\" --description \"Updated the wright framework. Created by Jenkins job.\"")
            }
        } else {
            println 'No changes found in the Wright framework'
        }
    }
}
