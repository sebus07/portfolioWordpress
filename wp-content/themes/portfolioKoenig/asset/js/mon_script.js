// Import du module fetch si nécessaire (décommenter pour Node.js)
// const fetch = require('node-fetch');

// Import de la clé API depuis config.js
import { GITHUB_API_KEY } from './config';

// Vérifiez que la clé est correctement importée
console.log(`Using GitHub API Key: ${GITHUB_API_KEY}`);

// Le reste du code reste inchangé

const repositories = [
  { username: 'sebus07', repo: 'koukaki' }, 
  { username: 'sebus07', repo: 'motaphoto1' }, 
  { username: 'sebus07', repo: 'Planty' }, 
  { username: 'sebus07', repo: 'portfolio_sebastien_Koenig' }, 
  { username: 'sebus07', repo: 'portfolioAstro' }

];

async function fetchRepoInfo(username, repo) {
  const repoUrl = `https://api.github.com/repos/${username}/${repo}`;
  const response = await fetch(repoUrl, {
    headers: {
      'Authorization': `token ${GITHUB_API_KEY}`,
      'User-Agent': 'Mozilla/5.0'
    }
  });
  if (!response.ok) {
    throw new Error(`Failed to fetch repository info for ${repo}: ${response.statusText}`);
  }
  return response.json();
}

async function fetchCommitsInfo(username, repo) {
  const commitsUrl = `https://api.github.com/repos/${username}/${repo}/commits`;
  const response = await fetch(commitsUrl, {
    headers: {
      'Authorization': `token ${GITHUB_API_KEY}`,
      'User-Agent': 'Mozilla/5.0'
    }
  });
  if (!response.ok) {
    throw new Error(`Failed to fetch commits info for ${repo}: ${response.statusText}`);
  }
  return response.json();
}

async function displayRepositories() {
  const container = document.getElementById('github-repos');
  if (container) {
    for (const { username, repo } of repositories) {
      try {
        const repoInfo = await fetchRepoInfo(username, repo);
        const commitsInfo = await fetchCommitsInfo(username, repo);
        
        // Debugging logs
        console.log(`Repo Info for ${repo}:`, repoInfo);
        console.log(`Commits Info for ${repo}:`, commitsInfo);

        const repoDiv = document.createElement('div');
        repoDiv.classList.add('github-repo');
        
        const repoName = repoInfo.name ? repoInfo.name : 'Nom non défini';
        const repoLanguage = repoInfo.language ? repoInfo.language : 'Langue non définie';
        const commitsCount = Array.isArray(commitsInfo) ? commitsInfo.length : '0';
        const lastCommitDate = (Array.isArray(commitsInfo) && commitsInfo.length > 0 && commitsInfo[0].commit && commitsInfo[0].commit.committer && commitsInfo[0].commit.committer.date) ? new Date(commitsInfo[0].commit.committer.date).toLocaleDateString() : 'Date non définie';
        const repoUrl = repoInfo.html_url ? repoInfo.html_url : '#';

        repoDiv.innerHTML = `
          <h2>${repoName}</h2>
          <p><strong>Langage:</strong> ${repoLanguage}</p>
          <p><strong>Commits:</strong> ${commitsCount}</p>
          <p><strong>Dernier commit:</strong> ${lastCommitDate}</p>
          <p><a href="${repoUrl}" target="_blank">Voir sur GitHub</a></p>
        `;
        
        container.appendChild(repoDiv);
      } catch (error) {
        console.error('Error fetching repository information:', error);
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('github-repo');
        errorDiv.innerHTML = `<p>Erreur lors de la récupération des informations du dépôt ${repo}: ${error.message}</p>`;
        container.appendChild(errorDiv);
      }
    }
  }
}

document.addEventListener('DOMContentLoaded', displayRepositories);
