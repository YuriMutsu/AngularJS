package service;

import models.DependencyVO;
import org.junit.Before;
import org.junit.Test;

import java.util.ArrayList;
import java.util.List;

import static org.junit.Assert.assertEquals;

public class ArtifactConverterImplTest {
    private ArtifactConvertImpl m_artifactConverter;
    private DependencySearcher m_dependencySearcher;

    private static final String POM_FILE_CONTAIN_GROUPID =
            "<searchNGResponse>\n" + "    <totalCount>1</totalCount>\n" + "    <from>-1</from>\n" + "    <count>-1</count>\n"
                    + "    <tooManyResults>false</tooManyResults>\n" + "    <collapsed>false</collapsed>\n" + "    <repoDetails>\n"
                    + "        <org.sonatype.nexus.rest.model.NexusNGRepositoryDetail>\n"
                    + "            <repositoryId>releases</repositoryId>\n" + "            <repositoryName>Releases</repositoryName>\n"
                    + "            <repositoryContentClass>maven2</repositoryContentClass>\n"
                    + "            <repositoryKind>hosted</repositoryKind>\n"
                    + "            <repositoryPolicy>RELEASE</repositoryPolicy>\n"
                    + "            <repositoryURL>http://tiger.in.alcatel-lucent.com:9999/nexus/service/local/repositories/releases</repositoryURL>\n"
                    + "        </org.sonatype.nexus.rest.model.NexusNGRepositoryDetail>\n" + "    </repoDetails>\n" + "    <data>\n"
                    + "        <artifact>\n" + "            <groupId>com.alcatel.axs.combo.plugins.cmts.5.1</groupId>\n"
                    + "            <artifactId>combocmts</artifactId>\n" + "            <version>5.1-1_9.4-264852</version>\n"
                    + "            <latestRelease>5.1-1_9.4-264852</latestRelease>\n"
                    + "            <latestReleaseRepositoryId>releases</latestReleaseRepositoryId>\n" + "            <artifactHits>\n"
                    + "                <artifactHit>\n" + "                    <repositoryId>releases</repositoryId>\n"
                    + "                    <artifactLinks>\n" + "                        <artifactLink>\n"
                    + "                            <extension>pom</extension>\n" + "                        </artifactLink>\n"
                    + "                    </artifactLinks>\n" + "                </artifactHit>\n" + "            </artifactHits>\n"
                    + "        </artifact>\n" + "    </data>\n" + "</searchNGResponse>";

    private static final String POM_FILE_CONTAIN_DEPENDENCY ="<project xmlns=\"http://maven.apache.org/POM/4.0.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://maven.apache.org/POM/4.0.0 http://maven.apache.org/maven-v4_0_0.xsd\">\n"
            + "<parent>\n" + "<groupId>com.alcatel.axs.generic.package</groupId>\n" + "<artifactId>comboplugs</artifactId>\n"
            + "<version>9.6-347546</version>\n" + "<relativePath>../../../generic.package/comboplugs/pom.xml</relativePath>\n"
            + "</parent>\n" + "<modelVersion>4.0.0</modelVersion>\n" + "<groupId>com.alcatel.axs.combo.plugins.isam.3.7</groupId>\n"
            + "<artifactId>comboisam</artifactId>\n" + "<packaging>pom</packaging>\n" + "<name>\n"
            + "${project.artifactId} ${project.version} combo plugin distribution package\n" + "</name>\n"
            + "<version>3.7-1_9.6-347546</version>\n" + "<scm>\n" + "<connection>\n"
            + "scm:svn:http://naweb.nmasd.bel.alcatel.be/svn/axs/basic.isam/trunk\n" + "</connection>\n" + "<developerConnection>\n"
            + "scm:svn:https://naweb.nmasd.bel.alcatel.be/svn/axs/basic.isam/trunk\n" + "</developerConnection>\n" + "</scm>\n"
            + "<dependencies>\n" + "<dependency>\n" + "<groupId>com.alcatel.axs.basic.isam.3.7</groupId>\n"
            + "<artifactId>isam</artifactId>\n" + "<version>3.7-1_9.6-347546</version>\n" + "<type>tar</type>\n"
            + "<scope>provided</scope>\n" + "</dependency>\n" + "<dependency>\n"
            + "<groupId>com.alcatel.axs.idm.app.plugins.isam.3.7</groupId>\n" + "<artifactId>idm-isam</artifactId>\n"
            + "<version>3.7-1_9.6-347546</version>\n" + "<type>tar</type>\n" + "<scope>provided</scope>\n" + "</dependency>\n"
            + "<!--\n" + "   <dependency>\n" + "      <groupId>com.alcatel.axs.spfe.app.plugins.isam.3.7</groupId>\n"
            + "      <artifactId>spfe-isam</artifactId>\n" + "      <version>null</version>\n" + "      <type>tar</type>\n"
            + "      <scope>provided</scope>\n" + "    </dependency>\n" + "    <dependency>\n"
            + "      <groupId>com.alcatel.axs.apc.app.plugins.isam.3.7</groupId>\n" + "      <artifactId>apc-isam</artifactId>\n"
            + "      <version>null</version>\n" + "      <type>tar</type>\n" + "      <scope>provided</scope>\n"
            + "    </dependency> \n" + "-->\n" + "</dependencies>\n" + "<build>\n" + "<plugins>\n" + "<plugin>\n"
            + "<artifactId>maven-dependency-plugin</artifactId>\n" + "</plugin>\n" + "<plugin>\n"
            + "<artifactId>maven-antrun-plugin</artifactId>\n" + "</plugin>\n" + "</plugins>\n" + "</build>\n" + "<properties>\n"
            + "<apps.name>isam</apps.name>\n" + "<docs.name>ISAM</docs.name>\n"
            + "<package.root.name>plugin-combo</package.root.name>\n"
            + "<generic.package.dir>../../../generic.package</generic.package.dir>\n" + "</properties>\n" + "</project>";

    @Before
    public void setUp() {
        m_artifactConverter = new ArtifactConvertImpl();
        m_dependencySearcher = new DependencySearcherImpl();
    }

    @Test
    public void testGetGroupId() {

        String expectedGroupId = "com.alcatel.axs.combo.plugins.cmts.5.1";
        String actualGroupId = m_artifactConverter.getGroupIdFromPomFile(POM_FILE_CONTAIN_GROUPID);
        assertEquals(expectedGroupId, actualGroupId);
    }

    @Test
    public void testGetDependency() {
        DependencyVO dependencyVO = new DependencyVO();
        dependencyVO.setGroupId("com.alcatel.axs.combo.plugins.isam.3.7");
        dependencyVO.setArtifactId("comboisam");
        dependencyVO.setVersion("3.7-1_9.6-347546");
        DependencyVO expectedDependencyVO = m_artifactConverter.getDependencyVO(POM_FILE_CONTAIN_DEPENDENCY);
        assertEquals(dependencyVO.getArtifactId(), expectedDependencyVO.getArtifactId());
        assertEquals(dependencyVO.getGroupId(), expectedDependencyVO.getGroupId());
        assertEquals(dependencyVO.getVersion(), expectedDependencyVO.getVersion());
        List<DependencyVO> dependencyVOList = expectedDependencyVO.getDependencies();
        assertEquals(2, dependencyVOList.size());
        assertEquals("isam", dependencyVOList.get(0).getArtifactId());
        assertEquals("idm-isam", dependencyVOList.get(1).getArtifactId());
    }
}
