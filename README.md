# Ethical Demonstration of Website Defacement Using File Upload Vulnerability

**Objective:**

- Understand how attackers exploit file upload vulnerabilities to deface a website and how to protect against such attacks.
- One of the requirements for the KSJ assignment.

## Team Members

<table>
  <tr>
    <th>Nama</th>
    <th>NIM</th>
  </tr>
  <tr>
    <td>M. Dimas A. H.</td>
    <td>220441035</td>
  </tr>
  <tr>
    <td>Rafza Ray Firdaus</td>
    <td>220441043</td>
  </tr>
    <tr>
    <td>Rikko A.</td>
    <td>220441044</td>
  </tr>
</table>

## Diagram

### **Hacking Scheme**

![Skema Hacking](<Diagram/Skema Hacking.jpg>)

1. **Victim**:

   - The victim using a Windows laptop.

2. **Attacker**:

   - The hacker using a Kali Linux virtual machine (VM).

3. **Accessing Port and IP**:

   - The attacker accesses the victim's laptop using the same IP address and port (192.168.xxx.xxx:8080).

4. **Using the Same Port and IP**:
   - The attacker uses the same port and IP address to attempt entry into the victim's system.

### **Defacing and SQL Injection**

![Diagram Defacing](<Diagram/Diagram Defacing dan SQLi.jpg>)

1. **Attacker**:

   - The hacker attempting to breach the system.

2. **File Upload and SQL Inject**:

   - The attacker uploads malicious files or uses SQL injection techniques to exploit vulnerabilities in the application.

3. **Exploit Vulnerability Apps**:

   - The attacker exploits vulnerabilities in the application to gain access.

4. **Bruteforce Login APP/Server**:

   - The attacker uses brute force attacks to obtain login credentials for the system.

5. **Login to System**:

   - The attacker successfully logs into the system using the obtained credentials.

6. **Upload Webshell for Backdoor**:

   - The attacker uploads a webshell as a backdoor for remote control.

7. **Remote Execution**:

   - The attacker executes commands remotely via the webshell.

8. **Upload Deface Script**:

   - The attacker uploads a deface script to alter the website's appearance.

9. **Server (local)**:
   - The target server where the deface script is uploaded and executed.

The first diagram outlines a simple hacking scheme where the attacker accesses the victim's system using the same IP address and port. The second diagram explains the process of a defacing and SQL injection attack, involving multiple stages from uploading malicious files to remote execution and website defacement.

## Ethical Considerations

- **Always have permission:** Conduct security testing only on systems you own or have explicit permission to test.
- **Report vulnerabilities responsibly:** If you discover a vulnerability, report it to the website owner or responsible party through proper channels.

## Requirements

- VirtualBox with Kali Linux to act as the attacker.
- A laptop running the web server with the vulnerable website.
- Use [Deface Page Generator](https://tools.zone-xsec.com/defacer/sc-deface) to create the deface page.
- Use [PHP Web Shell](https://shell.prinsh.com/#home) to find a PHP web shell.

## Setup

### VirtualBox and Kali Linux

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) on your computer.
2. Download and install the [Kali Linux virtual machine](https://www.kali.org/get-kali/#kali-virtual-machines) from the official website.
3. Start the Kali Linux virtual machine in VirtualBox.

### Web Server Setup

1. Ensure your laptop is running a [web server](https://www.apachefriends.org/download.html) (e.g., XAMPP or WAMP) with PHP support.
2. Deploy a vulnerable website with a file upload functionality.

## Steps to Deface a Website Using a File Upload Vulnerability

### Step 1: Identify the File Upload Vulnerability

1. **Find the File Upload Form:**

   - Locate the form that allows users to upload files (e.g., `upload.php`) on the vulnerable website running on your laptop.

2. **Analyze the Form:**
   - Ensure the form accepts file uploads and check for any client-side validation.

### Step 2: Create a Web Shell Script

1. **Find a Web Shell:**

   - Go to [PHP Web Shell](https://shell.prinsh.com/#home) and select a PHP web shell script.

2. **Save the Script as `webshell.php`:**
   - Save the downloaded web shell as `webshell.php` on your Kali Linux machine.

### Step 3: Exploit the Vulnerability

1. **Upload the Web Shell:**

   - Use the vulnerable upload form on the website to upload `webshell.php`.

2. **Access the Web Shell:**

   - Navigate to the uploaded web shell (e.g., `http://your-laptop-ip/uploads/webshell.php`) from Kali Linux.

3. **Create the Deface Page:**

   - Use [Deface Page Generator](https://tools.zone-xsec.com/defacer/sc-deface) to generate a deface page.
   - Save the generated deface page as `deface.php`.

4. **Upload the Deface Page:**

   - Use the web shell to upload `deface.php` to the web root directory of the server.

5. **Change the Direction in the `login.php` File:**
   - Change the directio to the `deface.php` rather than to `dashboard.php`, make the user cannot access the dashboard.

### Step 4: Verify the Defacement

1. **Check the Website:**
   - Visit the homepage of the website from any browser to see if the deface content is displayed.

## Protecting Against File Upload Attacks

1. **Validate File Types:**

   ```php
   $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
   if (!in_array($_FILES['file']['type'], $allowed_types)) {
       die("File type not allowed.");
   }
   ```

2. **Validate File Extensions:**

   ```php
   $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
   $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
   if (!in_array($extension, $allowed_extensions)) {
       die("File extension not allowed.");
   }
   ```

3. **Use a Secure Directory for Uploads:**

   - Store uploaded files outside the web root directory to prevent direct access.

4. **Rename Uploaded Files:**

   ```php
   $new_name = uniqid() . '.' . $extension;
   move_uploaded_file($_FILES['file']['tmp_name'], "/path/to/uploads/$new_name");
   ```

5. **Set Proper Permissions:**

   - Ensure the upload directory has restrictive permissions.

6. **Implement Server-side Validation:**

   - Use server-side checks to validate the content and type of uploaded files.

7. **Regularly Update and Patch:**

   - Keep your server and applications updated with the latest security patches.

8. **Monitor and Log Uploads:**
   - Implement logging and monitoring of file uploads to detect and respond to malicious activities promptly.

## Conclusion

Understanding how file upload vulnerabilities can be exploited helps in implementing effective security measures to protect web applications. Always prioritize ethical practices and responsible disclosure when dealing with potential security issues.
