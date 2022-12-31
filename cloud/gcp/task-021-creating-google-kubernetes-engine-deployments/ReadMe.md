# Creating Google Kubernetes Engine Deployments


## High Level Objectives

- Create deployment manifests, deploy to cluster, and verify Pod rescheduling as nodes are disabled
- Trigger manual scaling up and down of Pods in deployments
- Trigger deployment rollout (rolling update to new version) and rollbacks
- Perform a Canary deployment


### Create deployment manifests and deploy to the cluster

- Connect

```bash
# set the environment variable for the zone and cluster name
export my_zone=us-central1-a
export my_cluster=standard-cluster-1

# Configure kubectl tab completion in Cloud Shell:
source <(kubectl completion bash)

# configure access to your cluster for the kubectl command-line tool, using the following command:
gcloud container clusters get-credentials $my_cluster --zone $my_zone

# In Cloud Shell enter the following command to clone the repository to the lab Cloud Shell:
git clone https://github.com/GoogleCloudPlatform/training-data-analyst

# Change to the directory that contains the sample files for this lab:
cd ~/ak8s/Deployments/

```


- Create a deployment manifest

- nginx-deployment.yaml
```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: nginx-deployment
  labels:
    app: nginx
spec:
  replicas: 3
  selector:
    matchLabels:
      app: nginx
  template:
    metadata:
      labels:
        app: nginx
    spec:
      containers:
        - name: nginx
          image: nginx:1.7.9
          ports:
            - containerPort: 80
```

- Apply

```bash
kubectl apply -f ./nginx-deployment.yaml

kubectl get deployments
```