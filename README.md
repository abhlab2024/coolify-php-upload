# File Upload App (Docker + Coolify)

A minimal PHP + Apache setup to upload files. Uploads are persisted using a Docker **named volume**.

## Run locally

```bash
docker compose up --build
# open http://localhost:8080
```

## Deploy on Coolify

1. Create a new **Docker Compose** application in Coolify.
2. Upload or point to this project (Git repository or ZIP).
3. Ensure a **Persistent Storage** is attached that maps the service volume `uploads`.
   - Coolify will create a named volume from `docker-compose.yml` automatically.
4. Deploy. Access the app via Coolify's exposed URL.

## Notes

- Files are saved in `/var/www/html/uploads` (persisted via the `uploads` volume).
- To change upload limits, edit values in `Dockerfile` under `uploads.ini`.
- This is a minimal demo—add validation (mime-type, size, antivirus) before using in production.
