# Modular Load Balancing with Terraform - Regional Load Bala

[https://www.cloudskillsboost.google](https://www.cloudskillsboost.google)

[Select - Quest -  Managing Cloud Infrastructure with Terraform](https://www.cloudskillsboost.google/paths)

**High Level Objectives**

- 

**Version Stack**

| Stack     | Version |
|-----------|---------|
| Terraform | 1.3.9   |

## Clone the examples repository

```bash
git clone https://github.com/GoogleCloudPlatform/terraform-google-lb
cd ~/terraform-google-lb/examples/basic
```


## TCP load balancer with regional forwarding rule

```bash
export GOOGLE_PROJECT=$(gcloud config get-value project)

terraform init

terraform plan

terraform apply


EXTERNAL_IP=$(terraform output | grep load_balancer_default_ip | cut -d = -f2 | xargs echo -n)


echo "http://${EXTERNAL_IP}"
```