# Use an official Ubuntu base image
FROM ubuntu:latest

# Set non-interactive installation mode
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache, PHP, Python, and Pip
RUN apt-get update && \
    apt-get install -y apache2 libapache2-mod-php php python3 python3-pip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Optionally set a default timezone, e.g., "Etc/UTC"
RUN ln -fs /usr/share/zoneinfo/Etc/UTC /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata

# Copy your PHP application
COPY src/ /var/www/html/

# Copy your Python scripts
COPY python/ /var/www/html/

# Install Python dependencies
COPY python/requirements.txt /usr/src/app/
RUN pip3 install -r /usr/src/app/requirements.txt

# Update Apache configuration to prioritize index.php
RUN sed -i 's/DirectoryIndex index.html/DirectoryIndex index.php index.html/' /etc/apache2/mods-enabled/dir.conf

# Expose the Apache port
EXPOSE 80

# Start Apache in the foreground
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

