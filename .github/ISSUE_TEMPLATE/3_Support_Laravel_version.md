---
name: "⚒️ Support Laravel Version"
about: 'If you want to support a new Laravel version.'
---

### Follow these steps:

  1. In the package's `composer.json` file:
    - Set all of the `illuminate/%` packages to the new version, i.e. `^6.0`;
    - Set the `php` version according to the Laravel's `composer.json`;
      - Make proper fixes in the `php` list within the `.github/workflows/tests.yml` file;
    - Set versions for all of the packages according to the Laravel's `composer.json`;
  2. Add a new row in the `README.md` file for the new version.
  3. Open the PR:
    - Make sure that all of the CI checks are passing;

### Next steps from my side:

  1. Merge the PR.
  2. Create the new branch, i.e. `6.x`.
  3. For the new branch, within the `README.md` file:
    - Fix the branch for badges, i.e., from `master` to `6.x`;
    - Set the branch for the installation command, i.e., `illuminated/package:^6.0`;
  4. Create a new release.
