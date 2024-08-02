# Contributing to SIMALU

Thank you for your interest in contributing to SIMALU! We welcome contributions from everyone. By following the steps below, you can help improve the project.

## Getting Started

### Fork the Repository

1. Navigate to the [SIMALU repository](https://github.com/ibnumardini/simalu) on GitHub.
2. Click the "Fork" button at the top-right corner of the page to create a copy of the repository under your GitHub account.

### Clone the Forked Repository

1. Go to your forked repository on GitHub.
2. Click the "Code" button and copy the URL.
3. Open your terminal and run the following command to clone the repository to your local machine:

   ```sh
   git clone https://github.com/your-username/simalu.git
   ```

Replace `your-username` with your GitHub username.

### Create a New Branch

1. Navigate to the cloned repository directory:
   
   ```sh
   cd simalu
   ```
   
3. Create a new branch for your changes:
   
   ```sh
   git checkout -b feat/awesome-feature
   ```

Replace `feat/awesome-feature` with a descriptive name for your branch.

## Making Changes

1. Make the necessary changes or additions to the code.
2. Ensure your code follows the project's coding standards and guidelines.
3. Test your changes thoroughly to ensure they work as expected.

## Committing Changes

1. Add the changed files to the staging area:
   
   ```sh
   git add .
   ```
   
3. Commit the changes with a descriptive message:
   
   ```sh
   git commit -m "feat: add detailed description of your awesome changes"
   ```

## Pushing Changes

1. Push your changes to your forked repository on GitHub:
   
   ```sh
   git push origin feat/awesome-feature
   ```

## Creating a Pull Request

1. Navigate to your forked repository on GitHub.
2. Click the "Compare & pull request" button.
3. Provide a descriptive title and detailed description for your pull request.
4. Click "Create pull request".

## Addressing Feedback

1. The repository maintainers may review your pull request and provide feedback or request changes.
2. Make the necessary changes and push them to your branch:
   
   ```sh
   git add .
   git commit -m "fix: incorporate feedback"
   git push origin feat/awesome-feature
   ```

## Keeping Your Fork Updated

To avoid conflicts, keep your fork updated with the upstream repository:

1. Add the upstream repository:
   
   ```sh
   git remote add upstream https://github.com/ibnumardini/simalu.git
   ```
   
3. Fetch the latest changes from the upstream repository:
   
   ```sh
   git fetch upstream
   ```
   
5. Merge the latest changes into your branch:
   
   ```sh
   git merge upstream/master
   ```

## Additional Tips

- Follow the repository's contribution guidelines and code of conduct.
- Make sure your code is well-running.
- If you have any questions or run into issues, feel free to ask for help by opening an issue.
- Join our [discord server](https://discord.gg/FnHMcUYF), for easier coordination and discussion.

We appreciate your contributions and thank you for helping improve SIMALU!
