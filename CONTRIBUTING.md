# Contributing Guidelines

🎉 **First of all, thanks for taking the time to contribute!** 🎉

## 🤔 How can I contribute?

Please to read [Code of CONDUCT](CODE_OF_CONDUCT.md) before start to contribute.

### ✍️ As a Technical Writter
The project requires contributors who are able to create manual presentations for users or developers. Visit [Discussions](https://github.com/SleekwareDB/sleekwaredb/discussions/categories/documentation) Page

### 👨‍💻 As a Developer
This project requires contributions from many developers to be of good use in the future.

As a developer, to be able to unite the vision and mission of the community, it's worth reading how SleekwareDB was developed and built using several technologies:

#### Backend
- [SleekDB](https://sleekdb.github.io) - A NoSQL Database made using PHP
- [RestServer](https://github.com/chriskacerguis/codeigniter-restserver) - CodeIgniter RestServer
- [Codeigniter](https://github.com/bcit-ci/CodeIgniter) -  Open Source PHP Framework (originally from EllisLab)

#### Frontend
- Or give your idea on [Discussions](https://github.com/SleekwareDB/sleekwaredb/discussions/categories/ideas)!

### 💡 As a Scientist
As an active contributor by providing practical suggestions and ideas that can be useful for the community. Visit [Discussions](https://github.com/SleekwareDB/sleekwaredb/discussions/categories/ideas) Page

### 🛠 Suggesting Enhancements

This section guides you through submitting an enhancement suggestion, including completely new features and minor improvements to existing functionality. Following these guidelines helps maintainers and the community understand your suggestion 📝 and find related suggestions. 🔎

Since GitHub Issue forms we only suggest you to include most information possible.

You can see **[issues](https://github.com/SleekwareDB/sleekwaredb/issues)** to see if the enhancement has already been suggested.
If it has, add a comment to the existing issue instead of opening a new one.

> **Note:** If you find a **Closed** issue that seems like it is the same thing that you're experiencing, open a new issue and include a link to the original issue in the body of your new one.
### 🟩 Your First Code Contribution

Unsure where to begin contributing to this project? You can start by looking through these beginner-friendly issues:

- [Beginner issues](good-first-issues) - issues that require less work.
- [Help wanted issues](help-wanted) - issues that are a bit more involved.

### 📣 Pull Requests

The process described here has several goals:

- Maintain the project's quality.
- Fix problems that are important to users.
- Engage the community in working toward the best possible outcome!
- Enable a sustainable system for maintainers to review contributions.

Please follow all instructions in [the template](https://github.com/SleekwareDB/sleekwaredb/blob/master/.github/PULL_REQUEST_TEMPLATE.md)

## Commit Message Guidelines 😎

In order to make git commit messages easier to read and faster to reason about, we follow some guidelines on most commits to keep the format predictable. Check [Conventional Commits specification](https://conventionalcommits.org/) for more information about our guidelines.

**Examples**:
```
ocs(changelog): update changelog to beta.5
docs: add API documentation to the bot
test(server): add cache tests to the movie resource
fix(web): add validation to phone input field
fix(web): remove avatar image from being required in form
fix(release): new API Endpoint
```

### Types
Must be one of the following:

- **build**: Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm).
- **ci**: Changes to our CI configuration files and scripts (example scopes: Circle, BrowserStack, SauceLabs)
- **docs**: Documentation only changes
- **feat**: A new feature
- **fix**: A bug fix
- **perf**: A code change that improves performance
- **refactor**: A code change that neither fixes a bug nor adds a feature
- **style**: Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
- **test**: Adding missing tests or correcting existing tests

## How to Contribute 🚀

- Please create an [issue](issues) before creating a pull request.
- Fork the repository and create a branch for any issue that you are working on.
- Create a pull request which will be reviewed and suggestions would be provided.
- Add Screenshots to help us know what changes you have done.

## How to make a pull request 🤔

**1.** Fork [this](https://github.com/SleekwareDB/sleekwaredb) repository.

**2.** Clone the forked repository.

```bash
git clone https://github.com/<your-username>/sleekwaredb.git
```

**3.** Navigate to the project directory.

```bash
cd sleekwaredb
```

**4.** Create a new branch

Kindly give your branch a more descriptive name like `feat-add-ethereum` instead of `patch-1`.

You could follow this convention. Some ideas to get you started:

- Feature Updates: `feat-<2-3-Words-Description>-<ISSUE_NO>`
- Bug Fixes: `fix-<2-3-Words-Description>-<ISSUE_NO>`
- Documentation: `docs-<2-3-Words-Description>-<ISSUE_NO>`
- And so on...

```bash
git checkout -b your-branch-name
```

**5.** Add the resource, please follow the guidelines following

- Add the link: `* [project-name](http://example.com/) - A short description ends with a period.`
  - Keep descriptions concise and **short**.
- Search previous Pull Requests or Issues before making a new one, as yours may be a duplicate.
- Don't mention `Web3` in the description as it's implied.
- Check your spelling and grammar.
- Remove any trailing whitespace.

Just a gentle reminder: **Try not to submit your own project. Instead, wait for someone finds it useful and submits it for you.**

**6.** Stage your changes and commit.

```bash
git add . # Stages all the changes
git commit -m "<your_commit_message>"
```

[**Follow our commit guide from above**](#style-guide-for-git-commit-messages-)

**7.** Push your local commits to the remote repository.

```bash
git push origin your-branch-name
```

**8.** Create a new [pull request](https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request) from `your-branch-name`

**9.** 🎉 Congratulations! You've made your first pull request! Now, you should just wait until the maintainers review your pull request.

## 🛑 Important

### ✅ Good Practice

- Comment on the issue to get assigned
- Create an issue before you make a Pull Request

### ❌ Bad Practice

- Creating PRs without assignment will not be accepted and will be closed.

## 📈 Getting started

- 😕 Not sure where to start? Join our community on [Discord](https://discord.gg/R35CEJPz)
- ✨ You can also take part in our [Community Discussions](https://github.com/SleekwareDB/sleekwaredb/discussions)

[repo]: https://github.com/SleekwareDB/sleekwaredb
[good-first-issues]: https://github.com/SleekwareDB/sleekwaredb/issues?q=is%3Aopen+is%3Aissue+label%3A%22good+first+issue%22
[help-wanted]: https://github.com/SleekwareDB/sleekwaredb/issues?q=is%3Aopen+is%3Aissue+label%3A%22help+wanted%22
[issues]: https://github.com/SleekwareDB/sleekwaredb/issues
[prs]: https://github.com/SleekwareDB/sleekwaredb/pulls

[conventional-commits]: https://www.conventionalcommits.org/en/v1.0.0/
