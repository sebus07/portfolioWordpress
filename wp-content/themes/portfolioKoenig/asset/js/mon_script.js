// Import du module fetch si nécessaire
// const fetch = require('node-fetch');

// Import de dotenv pour charger les variables d'environnement depuis un fichier .env
require('dotenv').config();

// Récupération de la clé d'API depuis les variables d'environnement
const apiKey = process.env.GITHUB_API_KEY;

const repositories = [
  { username: 'sebus07', repo: 'koukaki' }, 
  { username: 'sebus07', repo: 'motaphoto1' }, 
  { username: 'sebus07', repo: 'Planty' }, 
  { username: 'sebus07', repo: 'portfolio_sebastien_Koenig' }, 
];

async function fetchRepoInfo(username, repo) {
  const repoUrl = `https://api.github.com/repos/${username}/${repo}`;
  const response = await fetch(repoUrl, {
    headers: {
      'Authorization': `token ${apiKey}`
    }
  });
  return response.json();
}

async function fetchCommitsInfo(username, repo) {
  const commitsUrl = `https://api.github.com/repos/${username}/${repo}/commits`;
  const response = await fetch(commitsUrl, {
    headers: {
      'Authorization': `token ${apiKey}`
    }
  });
  return response.json();
}

async function displayRepositories() {
  const container = document.getElementById('github-repos');
  if (container) {
    for (const { username, repo } of repositories) {
      try {
        const repoInfo = await fetchRepoInfo(username, repo);
        const commitsInfo = await fetchCommitsInfo(username, repo);
        
        const repoDiv = document.createElement('div');
        repoDiv.classList.add('github-repo');
        repoDiv.innerHTML = `
          <h2>${repoInfo.name}</h2>
          <p><strong>Language:</strong> ${repoInfo.language}</p>
          <p><strong>Commits:</strong> ${commitsInfo.length}</p>
          <p><strong>Last Commit:</strong> ${new Date(commitsInfo[0].commit.committer.date).toLocaleDateString()}</p>
          <p><a href="${repoInfo.html_url}" target="_blank">Voir sur GitHub</a></p>
        `;
        
        container.appendChild(repoDiv);
      } catch (error) {
        console.error('Error fetching repository information:', error);
      }
    }
  }
}

displayRepositories();
