# Student Server Quickstart

Use this guide to connect to your assigned DBMS project server.

## 1. Use the data your instructor gives you

Your `student_id` is `s009`.

You will use these values:

- `ip_address`: `146.190.39.201`
- `ssh_username`: `setup`
- `ssh_port`: `22009`
- `setup_password`: `S=66P_B!k7K4t6Sc6L`
- `http_url`: `http://146.190.39.201:8009/`
- `mysql_host`: `146.190.39.201`
- `mysql_port`: `33069`
- `mysql_database`: `blog_s009`
- `mysql_student_user`: `student_s009`
- `mysql_user_password`: `bqtdKY2+Z*0Hk(Ptp-a6`

## 2. Connect with SSH

From your terminal:

```bash
ssh setup@146.190.39.201 -p 22009
```

Example:

```bash
ssh setup@146.190.39.201 -p 22009
```

When prompted, enter your `setup_password` from the CSV (`S=66P_B!k7K4t6Sc6L`).

## 3. Open your website

Open `http_url` from your row in a browser.

Example:

```text
http://146.190.39.201:8009/
```

Your VM serves project files from `/var/www/html`.

## 4. Connect to MySQL from terminal

From your own machine (or from the VM), use:

```bash
mysql -h 146.190.39.201 -P 33069 -u student_s009 -p blog_s009
```

Example:

```bash
mysql -h 146.190.39.201 -P 33069 -u student_s009 -p blog_s009
```

At the password prompt, enter `mysql_user_password` from your row (`bqtdKY2+Z*0Hk(Ptp-a6`).

## 5. Update your PHP DB connection file

In your project files (typically `/var/www/html/db_connect.php`), set:

- host: `146.190.39.201`
- port: `33069`
- database: `blog_s009`
- username: `student_s009`
- password: `bqtdKY2+Z*0Hk(Ptp-a6`

## 6. Optional: GUI access with SSH tunnel

If your SQL client prefers localhost, create a tunnel first:

```bash
ssh -N -L 3307:127.0.0.1:33069 setup@146.190.39.201 -p 22009
```

Then configure MySQL Workbench or DBeaver to connect to:

- Host: `127.0.0.1`
- Port: `3307`
- Username: `student_s009`
- Password: `bqtdKY2+Z*0Hk(Ptp-a6`
- Database: `blog_s009`

## 7. First-login checklist

- Change your `setup` account password immediately.
- Do not share or post any credentials from the CSV.
- Keep your SQL account credentials in a private file or password manager.
- If login fails, re-check your row fields and watch for copy/paste spaces.

## 8. Troubleshooting

- SSH timeout/refused: verify `ip_address` (`146.190.39.201`) and `ssh_port` (`22009`), then confirm campus/home firewall is not blocking outbound custom ports.
- Web page not loading: verify `http_url` exactly (`http://146.190.39.201:8009/`), including `http://` and port.
- MySQL access denied: verify `mysql_student_user` (`student_s009`), `mysql_user_password`, and `mysql_database` (`blog_s009`) from your row.
- If your shell says `mysql: command not found`, install a MySQL client or run the command from the VM.
